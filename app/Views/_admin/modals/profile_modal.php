<div class="modal fade" id="profile_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Profile</h1>
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
                    <form id="profile_form" action="javascript:void(0)">
                        <div class="mb-3">
                            <div class="mb-2 d-flex justify-content-center">
                                <img id="profile_image_preview" src="../public/img/uploads/default-user-image.png" alt="Profile Image" class="img-thumbnail" style="width: 150px; height: 150px; object-fit: cover; display: block;">
                            </div>
                            <input type="file" class="form-control" id="profile_image" accept="image/*">
                        </div>
                        <div class="mb-3">
                            <label for="profile_name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="profile_name" placeholder="Enter your name" required>
                        </div>
                        <div class="mb-3">
                            <label for="profile_email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="profile_email" placeholder="Enter your email" required>
                            <small class="text-danger d-none" id="error_profile_email">Email already exists</small>
                        </div>
                        <div class="mb-3">
                            <label for="profile_password" class="form-label">Password</label>
                            <input type="password" class="form-control ignore-validation" id="profile_password" placeholder="Leave blank if you don't want to change your password">
                            <small class="text-danger d-none" id="error_profile_password">Passwords do not match</small>
                        </div>
                        <div class="mb-3">
                            <label for="profile_confirm_password" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control ignore-validation" id="profile_confirm_password" placeholder="Leave blank if you don't want to change your password">
                        </div>

                        <input type="hidden" id="profile_id">
                        <input type="hidden" id="profile_old_email">
                        <input type="hidden" id="profile_old_password">
                        <input type="hidden" id="profile_old_image">
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-submit" form="profile_form">Save changes</button>
            </div>
        </div>
    </div>
</div>