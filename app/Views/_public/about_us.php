<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Samar Online Radio - About Us</title>

    <!-- Meta tags -->
    <meta name="description" content="Listen to Samar Online Radio for non-stop music, latest hits, and live DJ sessions. Connecting Samar to the World!" />
    <meta name="keywords" content="Samar Online Radio, Online Radio, Live DJ, Music Streaming, Philippines Radio" />
    <meta name="author" content="Samar Online Radio Team" />
    <meta name="robots" content="index, follow" />

    <!-- Open Graph -->
    <meta property="og:title" content="Samar Online Radio - Connecting Samar to the World" />
    <meta property="og:description" content="Tune in for non-stop music, latest hits, and live DJ sessions. Join the vibe now!" />
    <meta property="og:image" content="public/img/cover.webp" />
    <meta property="og:url" content="https://samaronlineradio.com" />
    <meta property="og:type" content="website" />

    <!-- Twitter Cards -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="Samar Online Radio - Connecting Samar to the World" />
    <meta name="twitter:description" content="Listen to the latest hits and live DJ sessions at Samar Online Radio." />
    <meta name="twitter:image" content="public/img/cover.webp" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico?v=3.3.3" type="image/x-icon" />

    <link rel="stylesheet" href="public/admin/dist/css/adminlte.css?v=1.0.1" />
    <link rel="stylesheet" href="public/home/dist/css/about_us_styles.css?v=1.0.6" />
</head>

<body>
    <div class="container mt-3 mb-3">
        <div class="text-center mb-3">
            <img src="public/img/logo.webp" alt="Samar Online Radio Logo" class="logo-img" />
        </div>

        <h1 class="text-center mb-5 hero-title">Samar Integrated Media</h1>

        <?php $image_counter = 1 ?>
        <?php while ($image_counter <= 12): ?>
            <div class="row mb-2">
                <div class="col">
                    <img src="public/img/about-us-images/<?= $image_counter ?>.jfif" class="img-fluid w-100 about_us_image" alt="About Samar Page <?= $image_counter ?>" />
                </div>
            </div>
            <?php $image_counter++ ?>
        <?php endwhile ?>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <p class="mb-0">&copy; 2025 Samar Online Radio.</p>
            <p class="mt-0 mb-2">All rights reserved.</p>
            <p class="footer-links-container">
                <a class="footer-links" href="<?= base_url() ?>">Homepage</a> |
                <a class="footer-links" href="https://www.facebook.com/profile.php?id=61572979705153&mibextid=kFxxJD" target="_blank" rel="noopener noreferrer">Official Facebook Page</a> |
                <a class="footer-links" href="https://youtube.com/@salvadord.e?si=Q4uZfjo_lp3pDhe6" target="_blank" rel="noopener noreferrer">YouTube Channel</a>
            </p>
        </div>
    </footer>

    <?php if (is_internet_available()): ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <?php else: ?>
        <script src="../public/admin/dist/js/bootstrap.min.js"></script>
        <script src="../public/admin/dist/js/jquery-3.7.1.min.js"></script>
    <?php endif ?>

    <script src="public/home/dist/js/script.js?v=1.0.1"></script>
</body>

</html>