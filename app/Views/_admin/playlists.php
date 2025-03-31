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
            <div class="d-flex justify-content-end mb-3">
                <button class="btn btn-primary" id="new_playlist_btn" data-bs-toggle="modal" data-bs-target="#add_playlist_modal">
                    <i class="bi bi-plus-lg"></i> New Playlist
                </button>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 datatable">
                            <thead class="table-light">
                                <tr>
                                    <th>Playlist Name</th>
                                    <th>Schedule</th>
                                    <th>Time Range</th>
                                    <th>Songs</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>