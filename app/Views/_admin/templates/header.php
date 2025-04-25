<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Samar Online Radio - <?= session()->get("title") ?></title>

    <meta name="robots" content="noindex, nofollow">

    <link rel="shortcut icon" href="../favicon.ico?v=1.0.0" type="image/x-icon">

    <?php if (is_internet_available()): ?>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css" integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg=" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI=" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css" integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0=" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css" integrity="sha256-+uGLJmmTKOqBr+2E6KDYs/NRsHxSkONXFHUL0fy2O/4=" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" integrity="sha384-w9ufcIOKS67vY4KePhJtmWDp4+Ai5DMaHvqqF85VvjaGYSW2AhIbqorgKYqIJopv" crossorigin="anonymous">
    <?php else: ?>
        <link rel="stylesheet" href="../public/admin/dist/css/fonts.css?v=1.0.2" />
        <link rel="stylesheet" href="../public/admin/dist/css/overlayscrollbars.min.css?v=1.0.2" />
        <link rel="stylesheet" href="../public/admin/dist/css/bootstrap-icons/font/bootstrap-icons.min.css?v=1.0.2" />
        <link rel="stylesheet" href="../public/admin/dist/css/apexcharts.css?v=1.0.2" />
        <link rel="stylesheet" href="../public/admin/dist/css/jsvectormap.min.css?v=1.0.2" />
        <link rel="stylesheet" href="../public/admin/dist/css/jquery.dataTables.min.css">
    <?php endif ?>

    <link rel="stylesheet" href="../public/admin/dist/css/adminlte.css?v=1.0.0" />
    <link rel="stylesheet" href="../public/admin/dist/css/styles.css?v=1.1.0" />
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div id="loading-overlay" class="position-fixed top-0 start-0 w-100 h-100 bg-white bg-opacity-75 d-flex justify-content-center align-items-center" style="z-index: 1050; display: none;">
        <div class="text-center">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-3 fw-bold">Please wait, the page is loading...</p>
        </div>
    </div>
    <div class="app-wrapper">
        <nav class="app-header navbar navbar-expand bg-body">
            <div class="container-fluid">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                            <i class="bi bi-list"></i>
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img src="../public/img/uploads/<?= $user["image"] ?>" class="user-image rounded-circle shadow" alt="User Image" />
                            <span class="d-none d-md-inline"><?= $user["name"] ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                            <li class="user-header text-bg-primary">
                                <img src="../public/img/uploads/<?= $user["image"] ?>" class="rounded-circle shadow" alt="User Image" />
                                <p>
                                    <?= $user["name"] ?>
                                    <small>Administrator</small>
                                </p>
                            </li>
                            <li class="user-footer">
                                <a href="javascript:void(0)" class="btn btn-default btn-flat" id="profile">Profile</a>
                                <a href="<?= base_url("/admin/logout") ?>" class="btn btn-default btn-flat float-end">Sign Out</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
            <div class="sidebar-brand">
                <a href="<?= base_url("admin") ?>" class="brand-link">
                    <img src="../public/img/logo.webp" alt="AdminLTE Logo" class="brand-image opacity-75 shadow" />
                    <span class="brand-text fw-light">Samar Online Radio</span>
                </a>
            </div>
            <div class="sidebar-wrapper">
                <nav class="mt-2">
                    <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="dashboard" class="nav-link <?= session()->get("current_tab") == "dashboard" ? "active" : null ?>">
                                <i class="nav-icon bi bi-speedometer2"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void(0)" id="public_page" class="nav-link">
                                <i class="nav-icon bi bi-globe"></i>
                                <p>
                                    Public Page
                                    <small class="bi bi-box-arrow-up-right ms-1"></small>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="music_files" class="nav-link <?= session()->get("current_tab") == "music_files" ? "active" : null ?>">
                                <i class="nav-icon bi bi-file-music"></i>
                                <p>Music Files</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="playlists" class="nav-link <?= session()->get("current_tab") == "playlists" ? "active" : null ?>">
                                <i class="nav-icon bi bi-music-player"></i>
                                <p>Playlists</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void(0)" class="nav-link" id="live_streaming">
                                <i class="nav-icon bi bi-mic"></i>
                                <p>
                                    Live Streaming
                                    <small class="bi bi-box-arrow-up-right ms-1"></small>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void(0)" id="server_music_player" class="nav-link">
                                <i class="nav-icon bi bi-play-circle"></i>
                                <p>
                                    Server Music Player
                                    <small class="bi bi-box-arrow-up-right ms-1"></small>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url("/admin/logout") ?>" class="nav-link">
                                <i class="nav-icon bi bi-box-arrow-right"></i>
                                <p>Sign Out</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>