<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>96.9 Kasugbong FM Can-Avid - Login</title>

    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css" integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI=" crossorigin="anonymous" />
    <link rel="stylesheet" href="../public/admin/dist/css/adminlte.css" />
    <link rel="stylesheet" href="../public/admin/dist/css/styles.css" />
</head>

<body class="login-page bg-body-secondary">
    <div class="login-box">
        <?php if (session()->get("response")): ?>
            <div class="alert alert-<?= session()->get("response")["alert_type"] ?> text-center" id="login_alert"><?= session()->get("response")["message"] ?></div>
        <?php endif ?>

        <div class="card">
            <div class="card-header text-center">
                <img src="../public/home/dist/img/logo.webp" alt="Kasugbong Logo" class="img-fluid" style="max-width: 200px;" />
            </div>
            <div class="card-body login-card-body">
                <p class="login-box-msg">Please log in to continue</p>
                <form action="javascript:void(0)" method="post" id="login_form">
                    <div class="input-group mb-1">
                        <div class="form-floating">
                            <input id="login_email" type="email" class="form-control" value="<?= session()->get("remember_me") ? session()->get("remember_me")["email"] : null ?>" placeholder="" required />
                            <label for="login_email">Email</label>
                        </div>
                        <div class="input-group-text"><span class="bi bi-envelope"></span></div>
                    </div>
                    <div class="input-group mb-1">
                        <div class="form-floating">
                            <input id="login_password" type="password" class="form-control" value="<?= session()->get("remember_me") ? session()->get("remember_me")["password"] : null ?>" placeholder="" required />
                            <label for="login_password">Password</label>
                        </div>
                        <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
                    </div>

                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="login_remember_me" />
                        <label class="form-check-label" for="login_remember_me"> Remember Me </label>
                    </div>

                    <button type="submit" class="btn btn-primary w-100" id="login_submit">Sign In</button>

                    <div class="mt-3">
                        <span>Forgot your Password?</span>
                        <a href="javascript:void(0)" id="forgot_password">Click Here</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js" integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../public/admin/dist/js/adminlte.js"></script>
    <script src="../public/admin/dist/js/script.js?v=1.0.1"></script>
</body>

</html>