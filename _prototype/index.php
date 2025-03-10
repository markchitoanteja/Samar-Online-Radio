<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Samar Online Radio</title>

    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="dist/css/style.css?v=1.0.2">
</head>

<body>
    <div class="background">
        <div class="content">
            <img src="dist/img/logo.webp" alt="Logo" class="logo-kasugbong beating-image">
            <div class="iframe-container">
                <div class="song-details">
                    <img src="dist/img/logo.webp" alt="Song Image" class="song-image" style="width: 50px;">

                    <div class="song-info">
                        <div class="d-block">
                            <div class="song-name" id="songTitle">Loading...</div>
                            <div class="artist-name d-block" id="artist_name">King Ina</div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span id="currentTime" class="pr-2">0:00</span>
                            <div class="progress-container">
                                <div class="progress-bar" id="progressBar"></div>
                            </div>
                            <span id="duration" class="pl-2">0:00</span>
                        </div>
                    </div>
                </div>

                <hr class="divider mt-2 mb-0">

                <div class="controls mt-0">
                    <i id="playPauseButton" class="fas fa-play control-btn"></i>

                    <div class="volume-controls">
                        <i id="muteButton" class="fas fa-volume-up control-btn"></i>
                        <input type="range" id="volume" min="0" max="1" step="0.01" value="1">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer" id="footer">
        <div class="footer-content">
            <p class="copyright">© 2023 - <span id="current-year"></span> Kasugbong FM Can-Avid. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="dist/js/script.js?v=1.0.3"></script>
</body>

</html>