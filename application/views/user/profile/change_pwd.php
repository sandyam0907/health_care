<div class="container-fluid mt-3 mb-5">

    <!-- ===== BREADCRUMB ===== -->
    <nav aria-label="breadcrumb" class="mt-2">
        <ol class="breadcrumb bg-white shadow-sm mb-3" style="border-left:4px solid #1f518a;">
            <li class="breadcrumb-item">
                <a href="<?= base_url('user/dashboard') ?>">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Change Password</li>
        </ol>
    </nav>

    <?php $this->load->view('user/includes/_messages.php'); ?>

    <!-- ===== CARD ===== -->
    <div class="card shadow-sm">
        <div class="card-body">

            <!-- TITLE -->
            <div class="section-title mb-3">
                🔑 Change Password
            </div>

            <form method="post" action="<?= base_url('user/profile/change_password') ?>">

                <!-- CSRF -->
                <input type="hidden" 
                    name="<?= $this->security->get_csrf_token_name(); ?>" 
                    value="<?= $this->security->get_csrf_hash(); ?>">

                <div class="row">

                    <!-- OLD PASSWORD -->
                    <div class="col-lg-4 col-md-6 mb-3">
                        <label>Old Password</label>
                        <input type="password" name="old_password" class="form-control" required>
                    </div>

                    <!-- NEW PASSWORD -->
                    <div class="col-lg-4 col-md-6 mb-3">
                        <label>New Password</label>
                        <input type="password" name="new_password" class="form-control" required>
                    </div>

                    <!-- CONFIRM PASSWORD -->
                    <div class="col-lg-4 col-md-6 mb-3">
                        <label>Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control" required>
                    </div>

                </div>

                <!-- BUTTON -->
                <div class="text-right mt-3">
                    <button class="btn btn-primary px-4">
                        <i class="fa fa-key"></i> Update Password
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>

