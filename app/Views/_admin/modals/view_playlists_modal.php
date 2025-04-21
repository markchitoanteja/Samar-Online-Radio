<style>
    .playlist-list {
        max-height: 320px;
        overflow-y: auto;
        padding-right: 5px;
    }

    .playlist-list::-webkit-scrollbar {
        width: 6px;
    }

    .playlist-list::-webkit-scrollbar-thumb {
        background-color: rgba(0, 0, 0, 0.1);
        border-radius: 3px;
    }

    .playlist-list .playlist-card {
        border-radius: 1rem;
        transition: box-shadow 0.2s ease-in-out, transform 0.2s ease;
        background-color: #fdfdfd;
    }

    .playlist-list .playlist-card:hover {
        box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.08);
        transform: translateY(-2px);
    }

    .playlist-thumb {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 0.5rem;
    }

    .playlist-badge {
        font-size: 0.7rem;
        vertical-align: middle;
    }
</style>

<div class="modal fade" id="view_playlists_modal" tabindex="-1" aria-labelledby="addPlaylistModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPlaylistModalLabel">Playlists of this Song</h5>
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
                    <div class="playlist-list">
                        <div class="card mb-3 playlist-card">
                            <div class="card-body d-flex align-items-start">
                                <div class="d-flex align-items-center flex-grow-1">
                                    <img src="../public/img/audio-placeholder.webp" alt="Playlist Cover" class="playlist-thumb me-3">
                                    <div>
                                        <h5 class="mb-1 fw-semibold">Chocolate Factory <span class="badge bg-success ms-2">Public</span></h5>
                                        <small class="text-muted">25 songs · Created on Mar 12, 2023</small>
                                    </div>
                                </div>
                                <div class="d-flex flex-column align-items-end ms-3">
                                    <button class="btn btn-outline-danger btn-sm align-self-start">Remove</button>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3 playlist-card">
                            <div class="card-body d-flex align-items-start">
                                <div class="d-flex align-items-center flex-grow-1">
                                    <img src="../public/img/audio-placeholder.webp" alt="Playlist Cover" class="playlist-thumb me-3">
                                    <div>
                                        <h5 class="mb-1 fw-semibold">Chocolate Factory <span class="badge bg-success ms-2">Public</span></h5>
                                        <small class="text-muted">25 songs · Created on Mar 12, 2023</small>
                                    </div>
                                </div>
                                <div class="d-flex flex-column align-items-end ms-3">
                                    <button class="btn btn-outline-danger btn-sm align-self-start">Remove</button>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3 playlist-card">
                            <div class="card-body d-flex align-items-start">
                                <div class="d-flex align-items-center flex-grow-1">
                                    <img src="../public/img/audio-placeholder.webp" alt="Playlist Cover" class="playlist-thumb me-3">
                                    <div>
                                        <h5 class="mb-1 fw-semibold">Chocolate Factory <span class="badge bg-success ms-2">Public</span></h5>
                                        <small class="text-muted">25 songs · Created on Mar 12, 2023</small>
                                    </div>
                                </div>
                                <div class="d-flex flex-column align-items-end ms-3">
                                    <button class="btn btn-outline-danger btn-sm align-self-start">Remove</button>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3 playlist-card">
                            <div class="card-body d-flex align-items-start">
                                <div class="d-flex align-items-center flex-grow-1">
                                    <img src="../public/img/audio-placeholder.webp" alt="Playlist Cover" class="playlist-thumb me-3">
                                    <div>
                                        <h5 class="mb-1 fw-semibold">Chocolate Factory <span class="badge bg-success ms-2">Public</span></h5>
                                        <small class="text-muted">25 songs · Created on Mar 12, 2023</small>
                                    </div>
                                </div>
                                <div class="d-flex flex-column align-items-end ms-3">
                                    <button class="btn btn-outline-danger btn-sm align-self-start">Remove</button>
                                </div>
                            </div>
                        </div>

                        <!-- Empty State -->
                        <!-- <h3 class="text-center py-5 text-muted">This song is not in any playlist yet.</h3> -->
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>