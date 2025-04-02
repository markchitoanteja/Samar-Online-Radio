<div class="modal fade" id="edit_music_modal" tabindex="-1" aria-labelledby="editMusicModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editMusicModalLabel">Edit Music</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="loading py-5 text-center d-none">
                <div class="spinner-border" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <h3 class="mt-2">Please wait</h3>
            </div>
            <div class="main-form">
                <div class="modal-body">
                    <form action="javascript:void(0)" id="edit_music_form">
                        <div class="mb-3">
                            <label for="edit_music_title" class="form-label">Music Title</label>
                            <input type="text" class="form-control" id="edit_music_title" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_artist_name" class="form-label">Artist Name</label>
                            <input type="text" class="form-control" id="edit_artist_name">
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="edit_music_duration" class="form-label">Duration</label>
                                <input type="text" class="form-control" id="edit_music_duration" readonly required>
                            </div>
                            <div class="col-6">
                                <label for="edit_music_size" class="form-label">File Size</label>
                                <input type="text" class="form-control" id="edit_music_size" readonly required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="edit_music_file" class="form-label">Replace Music File</label>
                            <input type="file" class="form-control" id="edit_music_file" accept="audio/*">
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="edit_music_id">
                <input type="hidden" id="edit_music_old_file">

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-submit" form="edit_music_form">Save Changes</button>
            </div>
        </div>
    </div>
</div>