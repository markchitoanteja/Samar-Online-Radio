<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Server Music Player</title>

    <link rel="shortcut icon" href="../favicon.ico?v=1.0.1" type="image/x-icon" />

    <?php if (is_internet_available()): ?>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI=" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" integrity="sha384-w9ufcIOKS67vY4KePhJtmWDp4+Ai5DMaHvqqF85VvjaGYSW2AhIbqorgKYqIJopv" crossorigin="anonymous">
    <?php else: ?>
        <link rel="stylesheet" href="../public/admin/dist/css/fonts.css?v=1.0.2" />
        <link rel="stylesheet" href="../public/admin/dist/css/bootstrap-icons/font/bootstrap-icons.min.css?v=1.0.2" />
        <link rel="stylesheet" href="../public/admin/dist/css/jquery.dataTables.min.css">
    <?php endif ?>

    <link rel="stylesheet" href="../public/admin/dist/css/adminlte.css?v=1.0.0" />
    <link rel="stylesheet" href="../public/admin/dist/css/server_music_player_style.css?v=1.0.1" />
</head>

<body class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="playlist-title text-dark">Now Playing: <span class="text-primary" id="song_title">Loading...</span></div>
            </div>
        </div>
        <div class="row justify-content-center mb-4">
            <div class="col-md-10">
                <div class="card shadow-lg player-card border-0">
                    <div class="card-body">
                        <audio id="audioPlayer" class="w-100 my-3" controls controlsList="nodownload noremoteplayback nofullscreen">
                            Your browser does not support the audio element.
                        </audio>

                        <p class="text-muted small mb-0 text-center">Click the play button to start streaming.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-10">
                <hr>
            </div>
        </div>

        <!-- Playlist Title -->
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="playlist-title text-dark">Playlist Name: <span class="text-primary" id="playlist_name">Loading...</span></div>
            </div>
        </div>

        <!-- Music Table Card -->
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow border-0">
                    <div class="card-body">
                        <table class="table table-hover" id="music_table">
                            <thead class="table-light text-center">
                                <tr>
                                    <th>Music Title</th>
                                    <th>Artist Name</th>
                                    <th>Duration</th>
                                    <th>Size</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>test</td>
                                    <td>test</td>
                                    <td>test</td>
                                    <td>test</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const current_tab = "<?= session()->get("current_tab") ?>";
        const notification = <?= json_encode(session()->get("notification") ?? null) ?>;
    </script>

    <?php if (is_internet_available()): ?>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js" integrity="sha384-k5vbMeKHbxEZ0AEBTSdR7UjAgWCcUfrS8c0c5b2AfIh7olfhNkyCZYwOfzOQhauK" crossorigin="anonymous"></script>
    <?php else: ?>
        <script src="../public/admin/dist/js/popper.min.js"></script>
        <script src="../public/admin/dist/js/bootstrap.min.js"></script>
        <script src="../public/admin/dist/js/jquery-3.7.1.min.js"></script>
        <script src="../public/admin/dist/js/jquery.dataTables.min.js"></script>
    <?php endif ?>

    <script src="../public/admin/dist/js/adminlte.js"></script>
    <script src="../public/admin/dist/js/server_music_player_script.js?v=1.1.7"></script>
</body>

</html>