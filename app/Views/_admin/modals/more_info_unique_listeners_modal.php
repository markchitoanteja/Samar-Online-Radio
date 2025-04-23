<div class="modal fade" id="more_info_unique_listeners_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Unique Listeners</h1>
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
                    <div class="table-responsive">
                        <table class="table table-hover datatable" id="unique_listeners_table">
                            <thead class="table-light">
                                <tr>
                                    <th>IP Address</th>
                                    <th>User Agent</th>
                                    <th>Last Activity</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data from AJAX -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>