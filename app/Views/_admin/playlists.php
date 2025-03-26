<main class="app-main">
    <div class="app-content-header">
        <div class="border-bottom">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Playlists</h3>
                    </div>
                    <div class="col-sm-6">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-sm-end mb-0">
                                <li class="breadcrumb-item"><a href="<?= base_url("admin") ?>">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Playlists</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="card">
                
                <div class="card-body table-responsive">
                    <table class="table table-hover align-middle mb-0 datatable">
                        <thead class="table-light">
                            <tr class="align-middle">
                                <th>
                                    Playlist
                                    <button class="btn btn-sm btn-outline-primary ms-2"
                                            data-bs-toggle="modal"
                                            data-bs-target="#addPlaylistModal">
                                        <i class="bi bi-plus-lg"></i>
                                    </button>
                                </th>
                                <th>Schedule</th>
                                <th>Time Range</th>
                                <th># Songs</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <strong>OPM</strong><br>
                                    <span class="badge bg-secondary">Song-based</span>
                                    <span class="badge bg-primary">Scheduled</span>
                                </td>
                                <td>
                                    General Rotation<br>
                                    M,W,TH
                                </td>
                                <td>
                                    <small class="text-muted">(11 hours, 15 minutes, 37 seconds)</small>
                                </td>
                                <td>
                                    <a href="#" class="text-decoration-none fw-bold text-primary">133</a><br>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                        data-bs-target="#editPlaylistModal">Edit</button>
                                        <button class="btn btn-sm btn-outline-danger">Delete</button>
                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">More</button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#">Details</a></li>
                                            <li><a class="dropdown-item" href="#">Clone</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <!-- More rows here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
