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
        let currentSongIndex = 0;
        let audioElement = $('#audioPlayer')[0];
        let is_playing = true;
        let songs = [];

        function fetchSongsAndPlay() {
            $.ajax({
                url: '../get_current_playlist_songs',
                type: 'POST',
                dataType: 'JSON',
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.length > 0) {
                        songs = data;
                        currentSongIndex = 0;
                        playSong();
                    }
                },
                error: function(_, _, error) {
                    console.error(error);
                }
            });
        }

        function playSong() {
            if (songs.length === 0 || currentSongIndex >= songs.length) {
                is_playing = false;
                return;
            }

            is_playing = true;
            audioElement.src = songs[currentSongIndex];
            audioElement.load();
            audioElement.play();

            audioElement.onended = onSongEnd;
            startLogging();
        }

        function loadNextSong() {
            currentSongIndex++;
            if (currentSongIndex < songs.length) {
                playSong();
            } else {
                fetchSongsAndPlay();
            }
        }

        function logAudioData(audioElement) {
            const source = audioElement.src;
            const duration = audioElement.duration || 0;
            const progress = audioElement.currentTime || 0;

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
                    $('#song_title').text(JSON.parse(response));
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        }

        function startLogging() {
            setInterval(function() {
                logAudioData(audioElement);
            }, 1000);
        }

        function onSongEnd() {
            loadNextSong();
        }

        fetchSongsAndPlay();
    </script>
</body>

</html>