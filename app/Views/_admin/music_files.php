
<main class="app-main">
    <div class="app-content-header">
        <div class="border-bottom">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Music Files</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="<?= base_url("admin") ?>">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Music Files</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
    <div class="app-content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="border border-2 border-secondary border-dashed rounded-3 p-5 d-flex justify-content-center">
                        <button class="btn btn-primary px-4 py-2" data-bs-toggle="modal" data-bs-target="#uploadMusicModal">
                            <i class="bi bi-upload me-1"></i> Upload Music
                        </button>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <!-- Playlist Action Button -->
                    <div id="playlistButtonContainer" class="mb-3 d-none">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-plus-lg me-1"></i> Add to Playlist
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">My Playlist 1</a></li>
                                <li><a class="dropdown-item" href="#">My Playlist 2</a></li>
                                <li><a class="dropdown-item" href="#">My Playlist 3</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Table -->
                    <table class="table table-hover align-middle mb-0 datatable">
                        <thead>
                            <tr class="table-light vertical-align-center">
                                <th class="text-center align-middle">
                                    <input class="form-check-input select-all" type="checkbox" id="selectAllCheckbox">
                                    <label class="form-check-label ms-2 mb-0" for="selectAllCheckbox">All</label>
                                </th>
                                <th>Music Title</th>
                                <th>Duration</th>
                                <th>Size</th>
                                <th>Modified</th>
                                <th>Playlist</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="align-middle">
                                <td class="text-center">
                                    <input class="form-check-input row-checkbox" type="checkbox">
                                    <label class="form-check-label ms-2 mb-0">1</label>
                                </td>
                                <td>Song Name.mp3</td>
                                <td>3:45</td>
                                <td>5.2 MB</td>
                                <td>2025-03-18</td>
                                <td>My Playlist</td>
                                <td class="btn-group">
                                    <button class="btn btn-outline-primary btn-sm">Edit</button>
                                    <button class="btn btn-outline-danger btn-sm">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>



<!-- Custom CSS -->
<style>
    .border-dashed {
        border-style: dashed !important;
    }

    .form-check-input {
        transform: scale(1.2);
        cursor: pointer;
    }
</style>

<!-- JavaScript -->
<script>
    // Call function on DOM ready
    document.addEventListener("DOMContentLoaded", function () {
        setupMusicCheckboxes('selectAllCheckbox', 'row-checkbox', 'playlistButtonContainer');
    });

    
    function setupMusicCheckboxes(selectAllId, checkboxClass, playlistContainerId) {
        const selectAll = document.getElementById(selectAllId);
        const checkboxes = document.querySelectorAll(`.${checkboxClass}`);
        const playlistButtonContainer = document.getElementById(playlistContainerId);
    
        function togglePlaylistButton() {
            const anyChecked = Array.from(checkboxes).some(cb => cb.checked);
            if (playlistButtonContainer) {
                playlistButtonContainer.classList.toggle("d-none", !anyChecked);
            }
        }
    
        if (selectAll) {
            selectAll.addEventListener("change", function () {
                checkboxes.forEach(cb => cb.checked = selectAll.checked);
                togglePlaylistButton();
            });
        }
    
        checkboxes.forEach(cb => {
            cb.addEventListener("change", togglePlaylistButton);
        });
    }
</script>
