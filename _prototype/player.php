<?php
$songs = [
    'dist/uploads/Down.mp3',
    'dist/uploads/Feeling Like This.mp3'
];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>External Server Player</title>

    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
        const songs = <?= json_encode($songs) ?>;
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="dist/js/player_script.js?v=1.0.4"></script>
</body>

</html>