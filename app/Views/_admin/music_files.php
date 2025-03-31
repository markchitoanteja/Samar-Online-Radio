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
                <button class="btn btn-secondary d-none me-2" id="add_to_playlist_btn">
                    <i class="bi bi-music-note-list"></i> Add to Playlist
                </button>
                <button class="btn btn-primary" id="upload_music_btn" data-bs-toggle="modal" data-bs-target="#upload_music_modal">
                    <i class="bi bi-upload"></i> Upload Music
                </button>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table datatable table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center">
                                        <input class="form-check-input" type="checkbox" role="button">
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
                                <?php if ($songs): ?>
                                    <?php foreach ($songs as $song): ?>
                                        <tr>
                                            <td class="text-center">
                                                <input class="form-check-input" type="checkbox" value="<?= $song['id'] ?>" role="button">
                                            </td>
                                            <td><?= htmlspecialchars($song['title'], ENT_QUOTES, 'UTF-8') ?></td>
                                            <td><?= htmlspecialchars($song['duration'], ENT_QUOTES, 'UTF-8') ?></td>
                                            <td><?= htmlspecialchars($song['size'], ENT_QUOTES, 'UTF-8') ?></td>
                                            <td><?= date('F j, Y, g:i a', strtotime($song['updated_at'])) ?></td>
                                            <td>
                                                <?= isset($song['playlist_name']) && !empty($song['playlist_name']) ? htmlspecialchars($song['playlist_name'], ENT_QUOTES, 'UTF-8') : "Not Yet Available" ?>
                                            </td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-primary play_music_btn" title="Play Music" data-url="<?= base_url('../public/songs/' . htmlspecialchars($song['filename'], ENT_QUOTES, 'UTF-8')) ?>">
                                                    <i class="bi bi-play-fill"></i>
                                                </button>
                                                <button class="btn btn-sm btn-success edit_music_btn" title="Edit Music" data-id="<?= $song['id'] ?>">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger delete_music_btn" title="Delete Music" data-id="<?= $song['id'] ?>">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                <?php endif ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>