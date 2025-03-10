$(document).ready(function () {
    let currentSongIndex = 0;
    let audioElement = $('#audioPlayer')[0];
    let is_playing = true;

    function loadNextSong() {
        currentSongIndex++;

        if (currentSongIndex < songs.length) {
            is_playing = true;

            audioElement.src = songs[currentSongIndex];
            audioElement.load();
            audioElement.play();

            logAudioData(audioElement);
        } else {
            is_playing = false;
        }
    }

    function logAudioData(audioElement) {
        const source = audioElement.src;
        const filename = source.substring(source.lastIndexOf('/') + 1);
        const title = filename.replace(/\.[^/.]+$/, "");
        const duration = audioElement.duration || 0;
        const progress = audioElement.currentTime || 0;

        $('#song_title').text(title ? title : 'Unknown Track');

        const data = new FormData();

        data.append('sync_data', true);

        data.append('file', source);
        data.append('title', title);
        data.append('duration', duration);
        data.append('progress', progress);
        data.append('is_playing', is_playing);

        $.ajax({
            url: 'core/server.php',
            type: 'POST',
            data: data,
            processData: false,
            contentType: false,
            success: function () {
                // console.log('Data sent successfully');
            },
            error: function (error) {
                console.error('Error:', error);
            }
        });
    }

    function startLogging() {
        setInterval(function () {
            logAudioData(audioElement);
        }, 1000);
    }

    function onSongEnd() {
        loadNextSong();
    }

    audioElement.src = songs[currentSongIndex];
    audioElement.load();
    audioElement.onended = onSongEnd;

    startLogging();
});