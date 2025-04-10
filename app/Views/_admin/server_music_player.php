<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Server Music Player</title>

    <link rel="shortcut icon" href="../favicon.ico?v=1.0.1" type="image/x-icon">

    <link rel="stylesheet" href="../public/admin/dist/css/adminlte.css?v=1.0.0" />
</head>

<body class="bg-light d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow px-4 py-2" style="width: 400px;">
        <div class="card-body text-center">
            <h5 class="card-title">Now Playing:</h5>
            <p class="card-text font-weight-bold" id="song_title">Loading...</p>

            <audio id="audioPlayer" class="w-100 mb-3" controls controlsList="nodownload noremoteplayback nofullscreen">
                Your browser does not support the audio element.
            </audio>

            <p class="text-muted small">Click the play button to start streaming.</p>
        </div>
    </div>

    <script>
        const current_tab = "<?= session()->get("current_tab") ?>";
        const notification = <?= json_encode(session()->get("notification") ?? null) ?>;
    </script>

    <?php if (is_internet_available()): ?>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <?php else: ?>
        <script src="../public/admin/dist/js/jquery-3.7.1.min.js"></script>
    <?php endif ?>

    <script>
        $(document).ready(function() {
            let currentSongIndex = 0;
            let songs = [];
            let audioElement = $('#audioPlayer')[0];
            let is_playing = true;
            let savedSessionData = null;
            let loggingInterval = null;
            let playbackFailures = 0;

            fetchSessionIndex();

            function fetchSessionIndex() {
                $.ajax({
                    url: '../get_session_index',
                    type: 'GET',
                    dataType: 'JSON',
                    success: function(response) {
                        savedSessionData = response;
                        fetchSongsAndPlay();
                    },
                    error: function() {
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
                    success: function(data) {
                        if (!data || data.length === 0) {
                            console.warn("No songs in playlist. Reloading...");
                            setTimeout(() => location.reload(), 1500);
                            return;
                        }

                        songs = data.slice(); // make a copy
                        songs.sort(); // ensure consistency with saved signature

                        const newPlaylistSignature = JSON.stringify(songs);
                        let resumeIndex = 0;

                        if (
                            savedSessionData &&
                            JSON.stringify(JSON.parse(savedSessionData.playlist || "[]").sort()) === newPlaylistSignature
                        ) {
                            resumeIndex = parseInt(savedSessionData.index) || 0;
                        } else {
                            clearSavedSession();
                        }

                        playSong(newPlaylistSignature, resumeIndex);
                    },
                    error: function(_, _, error) {
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

                audioElement.play().then(() => {
                    console.log(`Playing: ${songs[currentSongIndex]}`);
                }).catch(err => {
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
                    fetchSongsAndPlay(); // Reload playlist at end
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
                    success: function() {
                        console.log('Session index and playlist saved');
                    },
                    error: function(error) {
                        console.error('Error saving session index:', error);
                    }
                });
            }

            function clearSavedSession() {
                saveSessionIndex(""); // Clear playlist signature
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
                    success: function(response) {
                        try {
                            $('#song_title').text(JSON.parse(response));
                        } catch (e) {
                            $('#song_title').text(response); // fallback
                        }
                    },
                    error: function(error) {
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
                    success: function(data) {
                        if (!data || data.length === 0) {
                            console.warn("No songs returned after song ended. Reloading...");
                            return location.reload();
                        }

                        const newSongs = data.slice();
                        newSongs.sort();

                        const currentList = JSON.stringify(songs.slice().sort());
                        const newList = JSON.stringify(newSongs);

                        if (currentList !== newList) {
                            songs = newSongs;
                            currentSongIndex = 0;
                            playSong(newList);
                        } else {
                            loadNextSong();
                        }
                    },
                    error: function(_, _, error) {
                        console.error(error);
                    }
                });
            }

            function handlePlaybackError() {
                console.error("Audio playback or load error.");
                playbackFailures++;
                if (playbackFailures >= 3) {
                    location.reload(); // Final fallback
                } else {
                    loadNextSong(); // Try next song
                }
            }
        });
    </script>
</body>

</html>