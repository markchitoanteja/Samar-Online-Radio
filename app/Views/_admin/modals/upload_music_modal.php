<div class="modal fade" id="upload_music_modal" tabindex="-1" aria-labelledby="uploadMusicModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadMusicModalLabel">Upload Music</h5>
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
                    <form action="javascript:void(0)" id="upload_music_form">
                        <!-- Album Art Preview -->
                        <div class="mb-3 text-center" id="album_art_container">
                            <label class="form-label d-block">Album Art</label>
                            <img id="music_image" src="../public/img/audio-placeholder.webp" alt="Album Art" class="img-thumbnail shadow" style="width: 100px; height: 100px;">
                        </div>
                        <!-- File Input -->
                        <div class="mb-3">
                            <label for="music_file" class="form-label">Music File</label>
                            <input type="file" class="form-control" id="music_file" accept="audio/*" required>
                            <small class="text-danger d-none" id="error_music_file">Only audio files are allowed</small>
                        </div>
                        <!-- Title -->
                        <div class="mb-3">
                            <label for="music_title" class="form-label">Music Title</label>
                            <input type="text" class="form-control" id="music_title" required>
                        </div>

                        <!-- Artist -->
                        <div class="mb-3">
                            <label for="artist_name" class="form-label">Artist Name</label>
                            <input type="text" class="form-control" id="artist_name">
                        </div>

                        <!-- Duration & Size -->
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="music_duration" class="form-label">Duration</label>
                                <input type="text" class="form-control" id="music_duration" readonly required>
                            </div>
                            <div class="col-6">
                                <label for="music_size" class="form-label">File Size</label>
                                <input type="text" class="form-control" id="music_size" readonly required>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-submit" form="upload_music_form">Upload</button>
            </div>
        </div>
    </div>
</div>