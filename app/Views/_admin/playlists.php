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
                        <table class="table table-hover mb-0" id="playlists_table">
                            <thead class="table-light">
                                <tr>
                                    <th>Playlist Name</th>
                                    <th>Playback Days</th>
                                    <th>Playback Time</th>
                                    <th>Total Songs</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($playlists): ?>
                                    <?php foreach ($playlists as $playlist): ?>
                                        <tr id="playlist_<?= $playlist['id'] ?>">
                                            <td><?= $playlist['name'] ?></td>
                                            <td><?= $playlist['schedule'] ?></td>
                                            <td><?= date("g:i A", strtotime(explode('-', $playlist['time_range'])[0])) . ' - ' . date("g:i A", strtotime(explode('-', $playlist['time_range'])[1])) ?></td>
                                            <td>
                                                <a href="javascript:void(0)" class="no-function" data-playlist-id="<?= $playlist['id'] ?>">
                                                    <?= ($songCount = count(array_filter(explode(',', trim($playlist['song_ids']))))) === 0 ? "No Song" : ($songCount === 1 ? "1 Song" : "$songCount Songs") ?>
                                                </a>
                                            </td>
                                            <td class="text-center" style="white-space: nowrap;">
                                                <button class="btn btn-sm btn-success edit_playlist_btn" title="Edit Playlist" data-id="<?= $playlist['id'] ?>">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger delete_playlist_btn" title="Delete Playlist" data-id="<?= $playlist['id'] ?>">
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