<div class="modal fade" id="editPlaylistModal" tabindex="-1" aria-labelledby="editPlaylistModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPlaylistModalLabel">Edit Playlist</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editPlaylistForm">
                    <div class="mb-3">
                        <label for="editPlaylistName" class="form-label">Playlist Name</label>
                        <input type="text" class="form-control" id="editPlaylistName" placeholder="Enter playlist name" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Schedule</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="editCheckAllDays">
                            <label class="form-check-label fw-bold" for="editCheckAllDays">Check All</label>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-check">
                                    <input class="form-check-input edit-day-checkbox" type="checkbox" id="editMonday">
                                    <label class="form-check-label" for="editMonday">Monday</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input edit-day-checkbox" type="checkbox" id="editTuesday">
                                    <label class="form-check-label" for="editTuesday">Tuesday</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input edit-day-checkbox" type="checkbox" id="editWednesday">
                                    <label class="form-check-label" for="editWednesday">Wednesday</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input edit-day-checkbox" type="checkbox" id="editThursday">
                                    <label class="form-check-label" for="editThursday">Thursday</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-check">
                                    <input class="form-check-input edit-day-checkbox" type="checkbox" id="editFriday">
                                    <label class="form-check-label" for="editFriday">Friday</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input edit-day-checkbox" type="checkbox" id="editSaturday">
                                    <label class="form-check-label" for="editSaturday">Saturday</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input edit-day-checkbox" type="checkbox" id="editSunday">
                                    <label class="form-check-label" for="editSunday">Sunday</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Time Range</label>
                        <div class="d-flex gap-2">
                            <input type="time" class="form-control" id="editTimeStart" value="08:00">
                            <input type="time" class="form-control" id="editTimeEnd" value="12:00">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<script>


</script>