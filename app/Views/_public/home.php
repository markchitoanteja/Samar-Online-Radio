<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Samar Online Radio | Connecting Samar to the World</title>

    <meta name="description" content="Samar Online Radio brings you 24/7 music, live DJ shows, and updates from Samar and the Philippines. Listen live now!" />
    <meta name="keywords" content="Samar Online Radio, Online Radio, Live DJ, Music Streaming, Filipino Music, Philippines Radio" />
    <meta name="author" content="Samar Online Radio Team" />
    <meta name="robots" content="index, follow" />

    <!-- Open Graph / Facebook -->
    <meta property="og:title" content="Samar Online Radio | Connecting Samar to the World" />
    <meta property="og:description" content="Samar Online Radio offers 24/7 music, DJ sessions, and news from the Philippines. Tune in now!" />
    <meta property="og:image" content="https://samaronlineradio.com/public/img/cover.webp" />
    <meta property="og:url" content="https://samaronlineradio.com" />
    <meta property="og:type" content="website" />

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="Samar Online Radio | Connecting Samar to the World" />
    <meta name="twitter:description" content="Enjoy nonstop Filipino music and live DJ sessions. Streaming 24/7 from Samar!" />
    <meta name="twitter:image" content="https://samaronlineradio.com/public/img/cover.webp" />

    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "RadioStation",
            "name": "Samar Online Radio",
            "url": "https://samaronlineradio.com",
            "logo": "https://samaronlineradio.com/public/img/logo.webp",
            "sameAs": [
                "https://www.facebook.com/profile.php?id=61572979705153",
                "https://youtube.com/@salvadord.e"
            ],
            "address": {
                "@type": "PostalAddress",
                "addressLocality": "Samar",
                "addressCountry": "PH"
            }
        }
    </script>

    <link rel="canonical" href="https://samaronlineradio.com/" />

    <link rel="shortcut icon" href="favicon.ico?v=3.3.3" type="image/x-icon" />

    <?php if (is_internet_available()): ?>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI=" crossorigin="anonymous" />
    <?php else: ?>
        <link rel="stylesheet" href="public/admin/dist/css/bootstrap-icons/font/bootstrap-icons.min.css?v=1.0.4" />
    <?php endif ?>

    <link rel="stylesheet" href="public/admin/dist/css/adminlte.css?v=1.0.1" />
    <link rel="stylesheet" href="public/home/dist/css/styles.css?v=2.4.5" />
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

    <div class="container">
        <div class="card music-player bg-light">
            <div class="card-header">
                <div class="logo-container">
                    <a href="https://www.facebook.com/share/16CqgDvcaT/?mibextid=qi2Omg" target="_blank" rel="noopener noreferrer">
                        <img src="public/img/logo-1.webp?v=1.0.1" class="border" alt="Company 1">
                    </a>
                    <a href="https://www.facebook.com/share/1BmFsRijP1/" target="_blank" rel="noopener noreferrer">
                        <img src="public/img/logo-2.webp?v=1.0.1" class="border" alt="Company 2">
                    </a>
                    <a href="https://www.facebook.com/share/1AFcs2Wxpy/" target="_blank" rel="noopener noreferrer">
                        <img src="public/img/logo-3.webp?v=1.0.4" class="border" alt="Company 3">
                    </a>
                </div>
                <div class="logo-container">
                    <a href="https://www.facebook.com/share/154qdLKajt/" target="_blank" rel="noopener noreferrer">
                        <img src="public/img/logo.webp?v=1.0.1" class="border" alt="Company 4">
                    </a>
                    <a href="https://www.facebook.com/profile.php?id=61572979705153&mibextid=kFxxJD" target="_blank" rel="noopener noreferrer">
                        <img src="public/img/logo-4.webp?v=1.0.1" class="border" alt="Company 5">
                    </a>
                </div>

                <h3 class="text-center mt-3 mb-0">Samar Online Radio</h3>
            </div>
            <div class="card-body w-100">
                <div class="iframe-container">
                    <div class="song-details">
                        <img id="album_art" src="public/img/audio-placeholder.webp?v=1.0.1" alt="Song Image" class="song-image" role="button">

                        <div class="song-info">
                            <div class="d-block">
                                <div class="ellipsis-container" onclick="this.classList.toggle('expanded')">
                                    <div class="song-name" id="songTitle">Loading...</div>
                                </div>

                                <div class="artist-name d-block" id="artist_name">Loading...</div>
                            </div>
                            <div class="d-flex justify-content-between mt-1">
                                <span id="currentTime" class="pr-2">0:00</span>
                                <div class="progress-container">
                                    <div class="progress-bar" id="progressBar"></div>
                                </div>
                                <span id="duration" class="pl-2">0:00</span>
                            </div>
                        </div>
                    </div>

                    <hr class="divider mt-2 mb-0 w-100">

                    <div class="controls mt-0">
                        <i id="playPauseButton" class="bi bi-play-fill control-btn" style="font-size: 24px;"></i>

                        <div class="volume-controls">
                            <i id="muteButton" class="bi bi-volume-up-fill control-btn" style="font-size: 24px;"></i>
                            <input type="range" id="volume" min="0" max="1" step="0.01" value="1" role="button">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="footer-content">
            <p class="mb-0">&copy; 2025 Samar Online Radio.</p>
            <p class="mt-0 mb-2">All rights reserved.</p>
            <p class="footer-links-container">
                <a class="footer-links" href="about_us" target="_blank" rel="noopener noreferrer">About Us</a> |
                <a class="footer-links" href="https://www.facebook.com/profile.php?id=61572979705153&mibextid=kFxxJD" target="_blank" rel="noopener noreferrer">Official Facebook Page</a> |
                <a class="footer-links" href="https://youtube.com/@salvadord.e?si=Q4uZfjo_lp3pDhe6" target="_blank" rel="noopener noreferrer">YouTube Channel</a>
            </p>
        </div>
    </footer>

    <?php if (is_internet_available()): ?>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php else: ?>
        <script src="../public/admin/dist/js/popper.min.js"></script>
        <script src="../public/admin/dist/js/bootstrap.min.js"></script>
        <script src="../public/admin/dist/js/jquery-3.7.1.min.js"></script>
        <script src="../public/admin/dist/js/sweetalert2@11.js"></script>
    <?php endif ?>

    <script src="public/home/dist/js/script.js?v=4.1.1"></script>
</body>

</html>