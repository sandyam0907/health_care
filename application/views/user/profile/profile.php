<div class="container-fluid mt-3 mb-5">

    <!-- ===== BREADCRUMB ===== -->
    <nav aria-label="breadcrumb" class="mt-2">
        <ol class="breadcrumb bg-white shadow-sm mb-3" style="border-left:4px solid #1f518a;">
            <li class="breadcrumb-item">
                <a href="<?= base_url('user/dashboard') ?>">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">My Profile</li>
        </ol>
    </nav>

    <?php $this->load->view('user/includes/_messages.php'); ?>

    <!-- ===== PROFILE CARD ===== -->
    <div class="card shadow-sm">
        <div class="card-body">

            <!-- TITLE -->
            <div class="section-title mb-3">
                👤 Profile Information
            </div>

            <form method="post" action="<?= base_url('user/profile/update_profile') ?>">

                <!-- CSRF -->
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                    value="<?= $this->security->get_csrf_hash(); ?>">

                <div class="row">

                    <!-- FIRST NAME -->
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                        <label>First Name</label>
                        <input type="text" name="firstname" class="form-control" value="<?= $user->firstname ?>">
                    </div>

                    <!-- LAST NAME -->
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                        <label>Last Name</label>
                        <input type="text" name="lastname" class="form-control" value="<?= $user->lastname ?>">
                    </div>

                    <!-- USERNAME -->
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" value="<?= $user->username ?>">
                    </div>

                    <!-- EMAIL -->
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="<?= $user->email ?>">
                    </div>

                    <!-- MOBILE -->
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                        <label>Mobile</label>
                        <input type="text" name="mobile_no" class="form-control" value="<?= $user->mobile_no ?>">
                    </div>

                    <!-- ADDRESS -->
                    <div class="col-lg-6 col-md-8 col-sm-12 mb-3">
                        <label>Address</label>
                        <input type="text" name="address" class="form-control" value="<?= $user->address ?>">
                    </div>

                </div>

                <!-- BUTTON -->
                <div class="text-right mt-3">
                    <button class="btn btn-primary px-4">
                        <i class="fa fa-save"></i> Update Profile
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>