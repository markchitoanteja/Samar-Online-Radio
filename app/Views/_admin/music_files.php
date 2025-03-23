<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Music Files</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="<?= base_url("admin") ?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Music Files</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-primary d-flex align-items-center gap-2 float-end">
                        <i class="bi bi-upload"></i>
                        Upload Music
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th><input type="checkbox"></th>
                                    <th>Name</th>
                                    <th>Length</th>
                                    <th>Size</th>
                                    <th>Modified</th>
                                    <th>Playlist</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td>Song Name.mp3</td>
                                    <td>3:45</td>
                                    <td>5.2 MB</td>
                                    <td>2025-03-18</td>
                                    <td>My Playlist</td>
                                    <td>
                                        <button class="btn btn-outline-primary btn-sm">Play</button>
                                        <button class="btn btn-outline-danger btn-sm">Delete</button>
                                    </td>
                                </tr>
                                <!-- Repeatable Rows for More Songs -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>