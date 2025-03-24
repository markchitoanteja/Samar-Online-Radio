<div class="modal fade" id="uploadMusicModal" tabindex="-1" aria-labelledby="uploadMusicModalLabel" aria-hidden="true">
    <div class="modal-dialog">
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
                    <form action="javascript:void(0)" method="POST" id="upload_music_form" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="musicTitle" class="form-label">Music Title</label>
                            <input type="text" class="form-control" id="music_title" required>
                        </div>
                        <div class="mb-3">
                            <label for="musicFile" class="form-label">Music File</label>
                            <input type="file" class="form-control" id="music_file" accept="audio/*" required>
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