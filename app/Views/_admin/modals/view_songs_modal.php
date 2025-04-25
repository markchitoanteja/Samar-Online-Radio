<div class="modal fade" id="view_songs_modal" tabindex="-1" aria-labelledby="addPlaylistModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header">
                <h5 class="modal-title" id="addPlaylistModalLabel">Songs of this Playlist</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="loading py-5 text-center d-none">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <h5 class="mt-3 text-muted">Please wait...</h5>
                </div>

                <div class="main-form">
                    <div class="mb-3 text-muted small">
                        <i class="bi bi-arrows-move me-1"></i>
                        Drag and drop the songs below to reorder them.
                    </div>

                    <div class="songs-list d-flex flex-column gap-3 overflow-auto" id="sortableSongs" style="max-height: 400px;">
                        <!-- Song cards are dynamically injected here -->
                    </div>
                </div>
            </div>

            <div class="modal-footer bg-light border-top-0">
                <input type="hidden" id="view_songs_playlist_id"/>

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-submit d-none" id="save_playlist_changes">Save Changes</button>
            </div>
        </div>
    </div>
</div>