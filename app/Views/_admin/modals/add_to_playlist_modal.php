<div class="modal fade" id="add_to_playlist_modal" tabindex="-1" aria-labelledby="addToPlaylistModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addToPlaylistModalLabel">Add to Playlist</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addToPlaylistForm" method="post" action="/admin/playlist/add">
                <div class="modal-body">
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
                        <input type="hidden" id="selectedSongIds" name="song_ids">
                    </div>
                    <div class="mb-3">
                        <label for="playlistSelect" class="form-label">Select Playlist</label>
                        <select class="form-select" id="playlistSelect" name="playlist_id" required>
                            <option value disabled selected>Select a playlist</option>
                            <?php foreach ($playlists as $playlist): ?>
                                <option value="<?= $playlist['id'] ?>"><?= htmlspecialchars($playlist['name'], ENT_QUOTES, 'UTF-8') ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add to Playlist</button>
                </div>
            </form>
        </div>
    </div>
</div>