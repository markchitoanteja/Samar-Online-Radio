<div class="modal fade" id="add_to_playlist_modal" tabindex="-1" aria-labelledby="addToPlaylistModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addToPlaylistModalLabel">Add to Playlist</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="loading py-5 text-center d-none">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>

                    <h3 class="mt-2">Please wait</h3>
                </div>
                <div class="main-form">
                    <form action="javascript:void(0)" id="add_to_playlist_form">
                        <div class="mb-3">
                            <label for="selectedSongs" class="form-label d-flex align-items-center">
                                Selected Songs
                                <span class="badge bg-primary ms-1" id="songCount">0</span>
                            </label>
                            <div class="border rounded p-2 bg-light">
                                <ul id="selectedSongs" class="list-group">
                                    <li class="list-group-item text-muted text-center">No songs selected</li>
                                </ul>
                            </div>
                            <input type="hidden" id="add_to_playlist_selected_song_ids">
                        </div>
                        <div class="mb-3">
                            <label for="add_to_playlist_playlist_id" class="form-label">Select Playlist</label>
                            <select class="form-select" id="add_to_playlist_playlist_id" required>
                                <option value disabled selected>Select a playlist</option>

                                <?php foreach ($playlists as $playlist): ?>
                                    <option value="<?= $playlist['id'] ?>"><?= htmlspecialchars($playlist['name'], ENT_QUOTES, 'UTF-8') ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-submit" form="add_to_playlist_form">Add to Playlist</button>
            </div>
        </div>
    </div>
</div>