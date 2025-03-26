<div class="modal fade" id="addPlaylistModal" tabindex="-1" aria-labelledby="addPlaylistModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="addPlaylistModalLabel">Add Playlist</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form id="addPlaylistForm">

                    <!-- Playlist Name -->
                    <div class="mb-3">
                        <label for="playlistName" class="form-label">Playlist Name</label>
                        <input type="text" class="form-control" id="playlistName" placeholder="Enter playlist name" required>
                    </div>

                    <!-- Schedule -->
                    <div class="mb-3">
                        <label class="form-label">Schedule (Days of the Week)</label>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="checkAllDays">
                            <label class="form-check-label fw-bold" for="checkAllDays">Check All</label>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-check"><input class="form-check-input day-checkbox" type="checkbox" id="sunday" value="Sunday"><label class="form-check-label" for="sunday">Sunday</label></div>
                                <div class="form-check"><input class="form-check-input day-checkbox" type="checkbox" id="monday" value="Monday"><label class="form-check-label" for="monday">Monday</label></div>
                                <div class="form-check"><input class="form-check-input day-checkbox" type="checkbox" id="tuesday" value="Tuesday"><label class="form-check-label" for="tuesday">Tuesday</label></div>
                                <div class="form-check"><input class="form-check-input day-checkbox" type="checkbox" id="wednesday" value="Wednesday"><label class="form-check-label" for="wednesday">Wednesday</label></div>
                            </div>
                            <div class="col-6">
                                <div class="form-check"><input class="form-check-input day-checkbox" type="checkbox" id="thursday" value="Thursday"><label class="form-check-label" for="thursday">Thursday</label></div>
                                <div class="form-check"><input class="form-check-input day-checkbox" type="checkbox" id="friday" value="Friday"><label class="form-check-label" for="friday">Friday</label></div>
                                <div class="form-check"><input class="form-check-input day-checkbox" type="checkbox" id="saturday" value="Saturday"><label class="form-check-label" for="saturday">Saturday</label></div>
                            </div>
                        </div>
                    </div>

                    <!-- Time Range -->
                    <div class="row mb-3">
                        <div class="col">
                            <label for="startTime" class="form-label">Start Time</label>
                            <input type="time" class="form-control" id="startTime" name="startTime" required>
                        </div>
                        <div class="col">
                            <label for="endTime" class="form-label">End Time</label>
                            <input type="time" class="form-control" id="endTime" name="endTime" required>
                        </div>
                    </div>

                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="addPlaylistForm" class="btn btn-primary">Save Playlist</button>
            </div>

        </div>
    </div>
</div>

<!-- Check All Script -->
<script>

</script>
