<div class="modal fade" id="edit_playlist_modal" tabindex="-1" aria-labelledby="editPlaylistModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPlaylistModalLabel">Edit Playlist</h5>
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
                    <form action="javascript:void(0)" id="edit_playlist_form">
                        <input type="hidden" id="playlist_id">
                        <div class="mb-3">
                            <label for="edit_playlist_name" class="form-label">Playlist Name</label>
                            <input type="text" class="form-control" id="edit_playlist_name" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="edit_days">Schedule (Days of the Week)</label>
                            <input type="hidden" id="edit_days" value="0" required>
                            <div class="form-check mb-2">
                                <input class="form-check-input ignore-validation" type="checkbox" id="edit_checkAllDays" role="button">
                                <label class="form-check-label fw-bold" for="edit_checkAllDays" role="button">Select All Days</label>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input role="button" class="form-check-input day-checkbox ignore-validation" type="checkbox" value="Monday" id="edit_monday">
                                        <label role="button" class="form-check-label" for="edit_monday">Monday</label>
                                    </div>
                                    <div class="form-check">
                                        <input role="button" class="form-check-input day-checkbox ignore-validation" type="checkbox" value="Tuesday" id="edit_tuesday">
                                        <label role="button" class="form-check-label" for="edit_tuesday">Tuesday</label>
                                    </div>
                                    <div class="form-check">
                                        <input role="button" class="form-check-input day-checkbox ignore-validation" type="checkbox" value="Wednesday" id="edit_wednesday">
                                        <label role="button" class="form-check-label" for="edit_wednesday">Wednesday</label>
                                    </div>
                                    <div class="form-check">
                                        <input role="button" class="form-check-input day-checkbox ignore-validation" type="checkbox" value="Thursday" id="edit_thursday">
                                        <label role="button" class="form-check-label" for="edit_thursday">Thursday</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input role="button" class="form-check-input day-checkbox ignore-validation" type="checkbox" value="Friday" id="edit_friday">
                                        <label role="button" class="form-check-label" for="edit_friday">Friday</label>
                                    </div>
                                    <div class="form-check">
                                        <input role="button" class="form-check-input day-checkbox ignore-validation" type="checkbox" value="Saturday" id="edit_saturday">
                                        <label role="button" class="form-check-label" for="edit_saturday">Saturday</label>
                                    </div>
                                    <div class="form-check">
                                        <input role="button" class="form-check-input day-checkbox ignore-validation" type="checkbox" value="Sunday" id="edit_sunday">
                                        <label role="button" class="form-check-label" for="edit_sunday">Sunday</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="edit_playlist_start_time" class="form-label">Start Time</label>
                                <input type="time" class="form-control" id="edit_playlist_start_time" required>
                            </div>
                            <div class="col-md-6">
                                <label for="edit_playlist_end_time" class="form-label">End Time</label>
                                <input type="time" class="form-control" id="edit_playlist_end_time" required>
                            </div>
                            <div class="col-md-12 mt-1 text-center d-none" id="edit_time_error_message">
                                <small class="text-danger">Start time cannot be later than end time</small>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="modal-footer">
                <input type="hidden" id="edit_playlist_id">

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="edit_playlist_form" class="btn btn-primary btn-submit">Save Changes</button>
            </div>
        </div>
    </div>
</div>