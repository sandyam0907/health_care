<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>UP Govt – Login | Preventive Health Platform</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="<?= base_url()?>assets/dist/css/bootstrap.min.css">

    <style>
        :root {
            --prime: #1f518a;
            --dark: #163e68;
        }

        html,
        body {
            height: 100%;
        }

        body {
            font-family: "Segoe UI", Roboto, Arial, sans-serif;
            background: #f4f6f9;
        }

        /* layout */
        .auth-wrapper {
            min-height: 100vh;
            display: flex;
        }

        /* LEFT PANEL */
        .auth-left {
            flex: 1;
            background: linear-gradient(135deg, var(--prime), var(--dark));
            color: #fff;
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .auth-left h1 {
            font-weight: 700;
            font-size: 32px;
        }

        .auth-left p {
            opacity: .9;
            font-size: 15px;
        }

        .feature {
            display: flex;
            align-items: start;
            margin-bottom: 18px;
        }

        .feature i {
            font-size: 20px;
            margin-right: 12px;
            margin-top: 3px;
        }

        .stat-box {
            display: flex;
            gap: 20px;
            margin-top: 30px;
        }

        .stat {
            background: rgba(255, 255, 255, .15);
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            flex: 1;
        }

        .stat h3 {
            margin: 0;
            font-weight: 700;
        }

        .stat small {
            opacity: .9;
        }

        /* RIGHT PANEL */
        .auth-right {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
        }

        .login-card {
            width: 100%;
            max-width: 420px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .1);
            padding: 30px;
        }

        .login-card h4 {
            font-weight: 600;
            color: var(--prime);
        }

        .form-control {
            height: 44px;
        }

        .btn-primary {
            background: var(--prime);
            border-color: var(--prime);
        }

        .footer-text {
            font-size: 12px;
            color: #777;
            margin-top: 15px;
            text-align: center;
        }

        @media(max-width:991px) {
            .auth-left {
                display: none;
            }
        }
    </style>
</head>

<body>

    <div class="auth-wrapper">

        <!-- LEFT CONTENT -->
        <div class="auth-left">
            <div>
                <h1>Government of Uttar Pradesh</h1>
                <p>Department of Health & Family Welfare</p>

                <div class="mt-4">
                    <div class="feature">
                        <i>✔</i>
                        <div>
                            <strong>Centralized Health Records</strong>
                            <p class="mb-0">Unified digital platform for preventive health screenings.</p>
                        </div>
                    </div>

                    <div class="feature">
                        <i>✔</i>
                        <div>
                            <strong>District-wise Analytics</strong>
                            <p class="mb-0">Real-time insights across all UP districts.</p>
                        </div>
                    </div>

                    <div class="feature">
                        <i>✔</i>
                        <div>
                            <strong>Secure & Compliant</strong>
                            <p class="mb-0">Government-grade data protection & audit trails.</p>
                        </div>
                    </div>
                </div>

                <div class="stat-box">
                    <div class="stat">
                        <h3>75+</h3>
                        <small>Districts</small>
                    </div>
                    <div class="stat">
                        <h3>2.4M+</h3>
                        <small>Screenings</small>
                    </div>
                    <div class="stat">
                        <h3>12K+</h3>
                        <small>Health Camps</small>
                    </div>
                </div>
            </div>

            <div>
                <small>“Digital health enables faster decisions and better outcomes.”</small>
            </div>
        </div>

        <!-- RIGHT LOGIN -->
        <div class="auth-right">
            <div class="login-card" >
                <h4 class="mb-2">Officer Login</h4>
                <p class="text-muted mb-4">Sign in to access the Preventive Health Platform</p>

                 <?php $this->load->view('user/includes/_messages.php') ?>
        
        <?php echo form_open(base_url('user/auth/login'), 'class="login-form" '); ?>

                    <div class="form-group">
                        <label>Email / Username</label>
                        <input type="text" class="form-control" placeholder="Enter your ID" name="username" id="name">
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" placeholder="Enter password" name="password" id="password">
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox">
                            <label class="form-check-label">Remember me</label>
                        </div>
                        <a href="#" class="small">Forgot password?</a>
                    </div>
<input type="submit" name="submit" id="submit" class="btn btn-primary btn-block" value="Login Securely">
                   
                </form>

                <div class="footer-text">
                    © Government of Uttar Pradesh<br>
                    Preventive Health IT Platform
                </div>
            </div>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?= base_url()?>assets/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>