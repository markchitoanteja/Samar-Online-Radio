<!DOCTYPE html>
<html lang="en" class="login-html">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Samar Online Radio - <?= session()->get("title") ?></title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="../favicon.ico?v=1.0.1" type="image/x-icon">

    <!-- Stylesheets -->
    <?php if (is_internet_available()): ?>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css" integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg=" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI=" crossorigin="anonymous" />
    <?php else: ?>
        <link rel="stylesheet" href="../public/admin/dist/css/fonts.css?v=1.0.2" />
        <link rel="stylesheet" href="../public/admin/dist/css/overlayscrollbars.min.css?v=1.0.2" />
        <link rel="stylesheet" href="../public/admin/dist/css/bootstrap-icons/font/bootstrap-icons.min.css?v=1.0.2" />
    <?php endif ?>

    <link rel="stylesheet" href="../public/admin/dist/css/adminlte.css?v=1.0.2" />
</head>

<body class="login-page bg-body-secondary">
    <div class="login-box">
        <?php if (session()->get("response")): ?>
            <div class="text-center alert alert-<?= session()->get("response")["alert_type"] ?>"><?= session()->get("response")["message"] ?></div>
        <?php endif ?>

        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <img src="../public/img/logo.webp" alt="Official Logo" class="img-fluid mb-3" style="max-width: 150px;">

                <h3 class="mb-0 fw-bold">Samar Online Radio</h3>
                <h4 class="mt-2">(Music Server)</h4>
            </div>
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <form action="javascript:void(0)" id="login_form">
                    <div class="input-group mb-1">
                        <div class="form-floating">
                            <input id="login_email" type="email" class="form-control" value="" placeholder="" required />
                            <label for="login_email">Email</label>
                        </div>
                        <div class="input-group-text"><span class="bi bi-envelope"></span></div>
                    </div>
                    <div class="input-group mb-1">
                        <div class="form-floating">
                            <input id="login_password" type="password" class="form-control" placeholder="" required />
                            <label for="login_password">Password</label>
                        </div>
                        <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mt-3" id="login_submit">Sign In</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        const base_url = "<?= base_url() ?>";
        const current_tab = "<?= session()->get("current_tab") ?>";
        const notification = <?= json_encode(null) ?>;
    </script>

    <?php if (is_internet_available()): ?>
        <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js" integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <?php else: ?>
        <script src="../public/admin/dist/js/overlayscrollbars.browser.es6.min.js"></script>
        <script src="../public/admin/dist/js/popper.min.js"></script>
        <script src="../public/admin/dist/js/bootstrap.min.js"></script>
        <script src="../public/admin/dist/js/jquery-3.7.1.min.js"></script>
    <?php endif ?>

    <script src="../public/admin/dist/js/adminlte.js"></script>
    <script src="../public/admin/dist/js/script.js?v=1.0.6"></script>
</body>

</html>