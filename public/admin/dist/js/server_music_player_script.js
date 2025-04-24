$(document).ready(function () {
    let currentSongIndex = 0;
    let songs = [];
    let is_playing = true;
    let savedSessionData = null;
    let loggingInterval = null;
    let playbackFailures = 0;
    let current_songs_data = null;
    let audioElement = $('#audioPlayer')[0];

    fetchSessionIndex();
    setInterval(update_listener_activity, 30000);

    var music_table = $('#music_table').DataTable({
        responsive: false,
        autoWidth: false,
        lengthChange: false,
        paging: false,
        searching: true,
        ordering: false,
        info: true,
        language: {
            search: 'Music Title:',
        }
    });

    $('#music_table_filter input').unbind().on('keyup', function () {
        music_table.column(0).search(this.value).draw();
    });

    function update_listener_activity() {
        $.ajax({
            url: '../update_listener_activity',
            type: 'POST',
            dataType: 'JSON',
            processData: false,
            contentType: false,
            error: function (_, _, error) {
                console.error(error);
            }
        });
    }

    function populateMusicTable(songs_data) {
        music_table.clear().draw();

        setTimeout(() => {
            songs_data.forEach((song, index) => {
                music_table.row.add([
                    `<span class="${index === currentSongIndex ? 'fw-bold text-primary' : ''}">${song.title}</span>`,
                    `<span class="${index === currentSongIndex ? 'fw-bold text-primary' : ''}">${song.artist}</span>`,
                    `<span class="${index === currentSongIndex ? 'fw-bold text-primary' : ''}">${song.duration}</span>`,
                    `<span class="${index === currentSongIndex ? 'fw-bold text-primary' : ''}">${song.size} MB</span>`
                ]);
            });

            music_table.draw();
        }, 100);
    }

    function fetchSessionIndex() {
        $.ajax({
            url: '../get_session_index',
            type: 'POST',
            dataType: 'JSON',
            success: function (response) {
                savedSessionData = response;
                fetchSongsAndPlay();
            },
            error: function () {
                savedSessionData = null;
                fetchSongsAndPlay();
            }
        });
    }

    function fetchSongsAndPlay() {
        $.ajax({
            url: '../get_current_playlist_songs',
            type: 'POST',
            dataType: 'JSON',
            processData: false,
            contentType: false,
            success: function (data) {
                if (!data || !data.songs || data.songs.length === 0) {
                    console.warn("No songs in playlist. Reloading...");
                    setTimeout(() => location.reload(), 1500);
                    return;
                }

                allSongData = data.songs;
                current_songs_data = allSongData;
                songs = allSongData.map(song => song.filename);
                const newPlaylistSignature = JSON.stringify(songs);
                let resumeIndex = 0;

                if (savedSessionData && savedSessionData.playlist === newPlaylistSignature) {
                    resumeIndex = parseInt(savedSessionData.index) || 0;
                } else {
                    clearSavedSession();
                }

                populateMusicTable(allSongData);

                $("#playlist_name").text(data.playlist_name || "Unknown Playlist");

                playSong(newPlaylistSignature, resumeIndex);
            },
            error: function (_, _, error) {
                console.error("Error fetching songs:", error);
                setTimeout(() => location.reload(), 1500);
            }
        });
    }

    function playSong(playlistSignature, index = null) {
        if (songs.length === 0) {
            is_playing = false;
            return;
        }

        if (index !== null) {
            currentSongIndex = index;
        }

        if (currentSongIndex >= songs.length) {
            currentSongIndex = 0;
        }

        is_playing = true;
        audioElement.src = songs[currentSongIndex];
        audioElement.load();

        audioElement.play().then(() => { }).catch(err => {
            console.error("Playback failed:", err);
            handlePlaybackError();
        });

        audioElement.onended = onSongEnd;
        audioElement.onerror = handlePlaybackError;

        saveSessionIndex(playlistSignature);
        startLogging();
    }

    function loadNextSong() {
        currentSongIndex++;
        saveSessionIndex(JSON.stringify(songs));

        if (currentSongIndex < songs.length) {
            playSong(JSON.stringify(songs));
        } else {
            fetchSongsAndPlay();
        }
    }

    function saveSessionIndex(playlistSignature) {
        const formData = new FormData();
        formData.append('index', currentSongIndex);
        formData.append('playlist', playlistSignature);

        $.ajax({
            url: '../save_session_index',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            error: function (error) {
                console.error('Error saving session index:', error);
            }
        });
    }

    function clearSavedSession() {
        saveSessionIndex("");
    }

    function logAudioData(audioElement) {
        const source = audioElement.src || '';
        const duration = audioElement.duration || 0;
        const progress = audioElement.currentTime || 0;

        if (!source) return;

        const data = new FormData();
        data.append('file', source);
        data.append('duration', duration);
        data.append('progress', progress);
        data.append('is_playing', is_playing);

        $.ajax({
            url: '../sync_data',
            type: 'POST',
            data: data,
            processData: false,
            contentType: false,
            success: function (response) {
                try {
                    $('#song_title').text(JSON.parse(response));
                } catch (e) {
                    $('#song_title').text(response);
                }
            },
            error: function (error) {
                console.error('Error syncing data:', error);
            }
        });
    }

    function startLogging() {
        if (loggingInterval) clearInterval(loggingInterval);
        loggingInterval = setInterval(() => logAudioData(audioElement), 1000);
    }

    function onSongEnd() {
        $.ajax({
            url: '../get_current_playlist_songs',
            type: 'POST',
            dataType: 'JSON',
            processData: false,
            contentType: false,
            success: function (data) {
                if (!data || !data.songs || data.songs.length === 0) {
                    console.warn("No songs returned after song ended. Reloading...");
                    return location.reload();
                }

                const newSongs = data.songs.map(song => song.filename);
                const currentList = JSON.stringify(songs);
                const newList = JSON.stringify(newSongs);

                if (currentList !== newList) {
                    songs = newSongs;
                    currentSongIndex = 0;

                    console.log("Playlist updated. Fetching new songs...");

                    fetchSongsAndPlay();

                    playSong(newList);
                } else {
                    console.log("Playlist unchanged. Continuing playback.");

                    populateMusicTable(current_songs_data);

                    loadNextSong();
                }
            },
            error: function (_, _, error) {
                console.error("Error checking updated playlist:", error);
            }
        });
    }

    function handlePlaybackError() {
        console.error("Audio playback or load error.");
        playbackFailures++;
        if (playbackFailures >= 3) {
            location.reload();
        } else {
            loadNextSong();
        }
    }
});
