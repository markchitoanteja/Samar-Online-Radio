<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Samar Online Radio - Connecting Samar to the World</title>

    <meta name="description" content="Listen to Samar Online Radio for non-stop music, latest hits, and live DJ sessions. Connecting Samar to the World!" />
    <meta name="keywords" content="Samar Online Radio, Online Radio, Live DJ, Music Streaming, Philippines Radio" />
    <meta name="author" content="Samar Online Radio Team" />
    <meta name="robots" content="index, follow" />

    <meta property="og:title" content="Samar Online Radio - Connecting Samar to the World" />
    <meta property="og:description" content="Tune in for non-stop music, latest hits, and live DJ sessions. Join the vibe now!" />
    <meta property="og:image" content="public/img/cover.webp" />
    <meta property="og:url" content="https://samaronlineradio.com" />
    <meta property="og:type" content="website" />

    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="Samar Online Radio - Connecting Samar to the World" />
    <meta name="twitter:description" content="Listen to the latest hits and live DJ sessions at Samar Online Radio." />
    <meta name="twitter:image" content="public/img/cover.webp" />

    <link rel="shortcut icon" href="favicon.ico?v=3.3.3" type="image/x-icon" />

    <?php if (is_internet_available()): ?>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI=" crossorigin="anonymous" />
    <?php else: ?>
        <link rel="stylesheet" href="public/admin/dist/css/bootstrap-icons/font/bootstrap-icons.min.css?v=1.0.4" />
    <?php endif ?>

    <link rel="stylesheet" href="public/admin/dist/css/adminlte.css?v=1.0.1" />
    <link rel="stylesheet" href="public/home/dist/css/styles.css?v=2.2.5" />
</head>

<body>
    <div id="loading-overlay" class="position-fixed top-0 start-0 w-100 h-100 bg-white bg-opacity-75 d-flex justify-content-center align-items-center" style="z-index: 1050; display: none;">
        <div class="text-center">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-3 fw-bold">Please wait, the page is loading...</p>
        </div>
    </div>

    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="music-section">
                    <img src="public/img/logo.webp?v=1.0.2" alt="Logo" class="logo-kasugbong" />

                    <div class="iframe-container mt-5">
                        <iframe id="music_player" src="https://radio.969fmcanavid.com/public/kasugbongfm/embed?theme=light" frameborder="0" allowtransparency="true" style="width: 100%; min-height: 150px; border: 0;"></iframe>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 mt-3">
                <div class="progress-container" id="progress-bars"></div>
            </div>
        </div>
    </div>

    <footer class="main-footer bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5><i class="bi bi-info-circle"></i> About Samar Online Radio</h5>
                    <p>Welcome to <strong>Samar Online Radio</strong>, your ultimate destination for non-stop music, live DJ sessions, and the latest hits. Connecting Samar to the world!</p>
                </div>
                <div class="col-md-4">
                    <h5>Contact Information</h5>
                    <ul class="list-unstyled">
                        <li>Email: info@samaronlineradio.com</li>
                        <li>Phone: +63 (912) 345 6789</li>
                        <li>Address: Eastern Samar, Philippines</li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Connect with Us</h5>
                    <ul class="list-unstyled">
                        <li>
                            <a href="https://www.facebook.com/profile.php?id=61572979705153&mibextid=kFxxJD" class="text-white text-decoration-none" target="_blank" rel="noopener noreferrer">
                                <i class="bi bi-facebook"></i>
                                Facebook
                            </a>
                        </li>
                        <li>
                            <a href="https://www.youtube.com/@salvadord.e" class="text-white text-decoration-none" target="_blank" rel="noopener noreferrer">
                                <i class="bi bi-youtube"></i>
                                Youtube
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="text-center mt-3">
            <p>Copyright <strong>&copy;</strong> <span id="current_year"></span> Samar Online Radio. All Rights Reserved.</p>
        </div>
    </footer>

    <?php if (is_internet_available()): ?>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php else: ?>
        <script src="../public/admin/dist/js/jquery-3.7.1.min.js"></script>
        <script src="../public/admin/dist/js/sweetalert2@11.js"></script>
    <?php endif ?>

    <script src="public/home/dist/js/script.js?v=3.3.7"></script>
</body>

</html>