<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Dashboard</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="<?= base_url("admin") ?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4">
                    <div class="small-box text-bg-primary">
                        <div class="inner">
                            <h3 id="current_listeners">0</h3>
                            <p>Current Listeners</p>
                        </div>
                        <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path d="M12 12c2.21 0 4-1.79 4-4S14.21 4 12 4 8 5.79 8 8s1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4zm6-7h2c1.1 0 2 .9 2 2v3h-2v-3h-2V7zm-2 1h-2V6h2V4h2v2h2v2h-2v2h-2V8z"></path>
                        </svg>
                        <a href="javascript:void(0)" id="more_info_current_listeners" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                            More info <i class="bi bi-link-45deg"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="small-box text-bg-success">
                        <div class="inner">
                            <h3 id="unique_listeners">0</h3>
                            <p>Unique Listeners</p>
                        </div>
                        <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path d="M12 12c2.21 0 4-1.79 4-4S14.21 4 12 4 8 5.79 8 8s1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"></path>
                        </svg>
                        <a href="javascript:void(0)" id="more_info_unique_listeners" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                            More info <i class="bi bi-link-45deg"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="small-box text-bg-warning">
                        <div class="inner">
                            <h3><span id="storage_usage"><?= $storage_usage ?></span>%</h3>
                            <p>Storage Usage</p>
                        </div>
                        <i class="small-box-icon bi bi-database-fill" style="font-size: 3rem; opacity: .4;" aria-hidden="true"></i>
                        <a href="javascript:void(0)" id="more_info_storage_usage" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                            More info <i class="bi bi-link-45deg"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 connectedSortable">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div id="listeners-chart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>