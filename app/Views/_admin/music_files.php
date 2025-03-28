<main class="app-main">
    <div class="app-content-header">
        <div class="border-bottom">
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
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="d-flex justify-content-end mb-3">
                <button class="btn btn-primary me-2">
                    <i class="bi bi-upload"></i> Upload Music
                </button>
                <button class="btn btn-secondary d-none">
                    <i class="bi bi-music-note-list"></i> Add to Playlist
                </button>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                    </div>
                    <table class="table datatable table-hover">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center">
                                    <input class="form-check-input" type="checkbox">
                                </th>
                                <th>Music Title</th>
                                <th>Duration</th>
                                <th>Size</th>
                                <th>Modified</th>
                                <th>Playlist</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">
                                    <input class="form-check-input" type="checkbox">
                                </td>
                                <td>Song A</td>
                                <td>3:45</td>
                                <td>4.5 MB</td>
                                <td>2023-10-01</td>
                                <td>Playlist 1</td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-success" onclick="editMusic('Song A')">
                                        <i class="bi bi-pencil"></i> Edit
                                    </button>
                                    <button class="btn btn-sm btn-danger" onclick="deleteMusic('Song A')">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>