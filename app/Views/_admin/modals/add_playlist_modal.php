<div class="modal fade" id="add_playlist_modal" tabindex="-1" aria-labelledby="addPlaylistModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPlaylistModalLabel">Add Playlist</h5>
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
                    <form action="javascript:void(0)" id="add_playlist_form">
                        <div class="mb-3">
                            <label for="playlist_name" class="form-label">Playlist Name</label>
                            <input type="text" class="form-control" id="playlist_name" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="days">Schedule (Days of the Week)</label>
                            <input type="hidden" id="days" value="0" required>

                            <div class="form-check mb-2">
                                <input class="form-check-input ignore-validation" type="checkbox" id="checkAllDays" role="button">
                                <label class="form-check-label fw-bold" for="checkAllDays" role="button">Select All Days</label>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input role="button" class="form-check-input day-checkbox ignore-validation" type="checkbox" value="Monday" id="monday">
                                        <label role="button" class="form-check-label" for="monday">Monday</label>
                                    </div>
                                    <div class="form-check">
                                        <input role="button" class="form-check-input day-checkbox ignore-validation" type="checkbox" value="Tuesday" id="tuesday">
                                        <label role="button" class="form-check-label" for="tuesday">Tuesday</label>
                                    </div>
                                    <div class="form-check">
                                        <input role="button" class="form-check-input day-checkbox ignore-validation" type="checkbox" value="Wednesday" id="wednesday">
                                        <label role="button" class="form-check-label" for="wednesday">Wednesday</label>
                                    </div>
                                    <div class="form-check">
                                        <input role="button" class="form-check-input day-checkbox ignore-validation" type="checkbox" value="Thursday" id="thursday">
                                        <label role="button" class="form-check-label" for="thursday">Thursday</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input role="button" class="form-check-input day-checkbox ignore-validation" type="checkbox" value="Friday" id="friday">
                                        <label role="button" class="form-check-label" for="friday">Friday</label>
                                    </div>
                                    <div class="form-check">
                                        <input role="button" class="form-check-input day-checkbox ignore-validation" type="checkbox" value="Saturday" id="saturday">
                                        <label role="button" class="form-check-label" for="saturday">Saturday</label>
                                    </div>
                                    <div class="form-check">
                                        <input role="button" class="form-check-input day-checkbox ignore-validation" type="checkbox" value="Sunday" id="sunday">
                                        <label role="button" class="form-check-label" for="sunday">Sunday</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="playlist_start_time" class="form-label">Start Time</label>
                                <input type="time" class="form-control" id="playlist_start_time" required>
                            </div>
                            <div class="col-md-6">
                                <label for="playlist_end_time" class="form-label">End Time</label>
                                <input type="time" class="form-control" id="playlist_end_time" required>
                            </div>
                            <div class="col-md-12 mt-1 text-center d-none" id="time_error_message">
                                <small class="text-danger">Start time cannot be later than end time</small>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="add_playlist_form" class="btn btn-primary btn-submit">Save Playlist</button>
            </div>
        </div>
    </div>
</div>