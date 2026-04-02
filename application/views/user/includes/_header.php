<!-- Notices and Notification dropdown -->
<?php
$CI =& get_instance();

$CI->load->model('admin/Notice_model', 'notice_model');
$CI->load->model('user/Dashboard_model', 'dashboard_model');

// Notices
$notices = $CI->notice_model->get_active_notices();

// Notifications
$project_id = $CI->session->userdata('project_id');
$notification = $CI->dashboard_model->get_notification_data($project_id);
?>



<!DOCTYPE html>
<html lang="en">
<?php
$url2 = $this->uri->segment(2);// Controller - instrumentexit;
?>

<head>
    <meta charset="UTF-8">
    <title>UP Govt – Preventive Health Report</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 4.6 -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">

    <!-- Font-awesome -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/font-awesome/css/font-awesome.min.css">

    <style>
        /* ===== global ===== */
        :root {
            --primeColor: #1f518a;
        }

        html,
        body {
            height: 100%;
        }

        body {
            display: flex;
            flex-direction: column;
            background: #f4f6f9;
            font-family: "Segoe UI", Roboto, Arial, sans-serif;
        }

        .main-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        /* ===== TOP GOV HEADER ===== */
        .gov-top-header {
            background: var(--primeColor);
            color: #fff;
            padding: 12px 25px;
        }

        .gov-top-header h5 {
            margin: 0;
            font-weight: 600;
        }

        .gov-top-header small {
            opacity: .85;
        }

        /* ===== NAVBAR ===== */
        .gov-navbar {
            background: #ffffff;
            border-bottom: 2px solid var(--primeColor);
            padding: 0px 25px;
        }

        .gov-navbar .nav-link {
            font-weight: 600;
            color: #333;
        }

        .gov-navbar .nav-link:hover {
            color: var(--primeColor);
        }

        /* ===== CARD & FORM ===== */
        .card {
            border-radius: 8px;

        }

        .newscreening .card {
            min-height: 65vh;
        }

        .nav-tabs .nav-link {
            font-weight: 500;
            color: #333;
        }

        .nav-tabs .nav-link.active {
            background: var(--primeColor);
            color: #fff;
        }


        .section-title {
            font-weight: 600;
            margin-bottom: 15px;
            color: var(--primeColor);
        }

        label {
            font-weight: 500;
            font-size: 14px;
        }

        /* ===== FOOTER ===== */
        .gov-footer {
            background: #ffffff;
            border-top: 2px solid var(--primeColor);
            padding: 12px 20px;
            font-size: 13px;
            color: #555;
        }

        /* ===== STICKY ACTION BAR ===== */
        .footer-btns {
            position: sticky;
            bottom: 0;
            background: #fff;
            border-top: 1px solid #ddd;
            padding: 12px;
            z-index: 99;
        }

        .nav-item {
            position: relative;
            margin-right: 20px;
            border-radius: 0;
        }

        .tab-content>.active {
            display: block;
            padding: 20px;
        }

        /* RIGHT ANGLE */
        .nav-tabs .nav-link.active::after {
            content: "";
            position: absolute;
            top: 1px;
            right: -19px;
            width: 0;
            height: 0;
            border-top: 20px solid transparent;
            border-bottom: 20px solid transparent;
            border-left: 20px solid var(--primeColor);
        }

        /* OPTIONAL: LEFT CUT (MORE PREMIUM) */
        .nav-tabs .nav-link::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 0;
            height: 0;
            border-top: 20px solid transparent;
            border-bottom: 20px solid transparent;
            border-left: 10px solid #f4f6f9;
        }

        .nav-tabs .nav-link.active::before {
            border-left-color: #f4f6f9;
        }

        .btn {
            font-size: .9rem !important;
            padding: 7px 15px !important;
            min-width: 100px;
        }

        .btn-success,
        .btn-primary {
            color: #fff;
            background-color: var(--primeColor) !important;
            border-color: var(--primeColor) !important;
            min-width: 140px;
        }

        .nav-tabs {
            border-bottom: 0px solid #dee2e6;
        }

        .nav-tabs .nav-link:focus,
        .nav-tabs .nav-link:hover {
            isolation: isolate;
            border-color: white !important;
        }

        .gov-header {
            background: linear-gradient(90deg, #1f518a, #163e68);
            color: #fff;
            padding: 10px 15px;
            z-index: 1030;
        }

        .gov-title {
            font-weight: 600;
            font-size: 15px;
            line-height: 1.2;
        }

        .gov-subtitle {
            font-size: 12px;
            opacity: .9;
        }

        .gov-logo {
            font-size: 22px;
        }

        .gov-notification {
            position: relative;
            font-size: 18px;
            cursor: pointer;
        }

        .notify-dot {
            position: absolute;
            top: 2px;
            right: 0;
            width: 7px;
            height: 7px;
            background: #ff3b3b;
            border-radius: 50%;
        }

        @media(max-width:768px) {
            .gov-title {
                font-size: 14px;
            }

            .gov-subtitle {
                font-size: 11px;
            }
        }

        @media(max-width:768px) {
            .nav-tabs {
                flex-wrap: nowrap;
                overflow-x: auto;
                overflow-y: hidden;
            }

            .nav-tabs .nav-item {
                flex: 0 0 auto;
            }
        }

        .gov-header {
            background: linear-gradient(90deg, #1f518a, #163e68);
            color: #fff;
            padding: 0;
            z-index: 1030;
        }


        .gov-title {
            font-weight: 600;
            font-size: 15px;
            line-height: 1.2;
        }

        .gov-subtitle {
            font-size: 12px;
            opacity: .9;
        }

        .gov-logo {
            font-size: 22px;
        }

        .gov-menu .nav-link {
            font-weight: 600;
            padding: 8px 14px;
        }

        .gov-menu .nav-link.active {
            background: rgba(255, 255, 255, .15);
            border-radius: 4px;
        }

        .notify-dot {
            position: absolute;
            top: 6px;
            right: 6px;
            width: 8px;
            height: 8px;
            background: #ff3b3b;
            border-radius: 50%;
        }

        .gov-user-circle {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: #fff;
            color: #1f518a;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
        }

        .gov-dropdown {
            min-width: 220px;
            font-size: 14px;
        }

        @media(max-width:768px) {
            .gov-title {
                font-size: 14px;
            }

            .gov-subtitle {
                font-size: 11px;
            }

            .gov-menu {
                margin-top: 10px;
            }
        }

        /* ===== ANALYTICS ===== */
        .stat-card h6 {
            font-size: 13px;
            color: #555;
        }

        .stat-card h3 {
            font-weight: 700;
        }

        .map-tooltip {
            position: absolute;
            background: #1f518a;
            color: #fff;
            padding: 6px 10px;
            font-size: 12px;
            border-radius: 4px;
            pointer-events: none;
            display: none;
            z-index: 9999;
        }

        svg rect {
            cursor: pointer;
            transition: opacity .15s;
        }

        svg rect:hover {
            opacity: .85;
        }

        /* Map focused layout */
        .map-card {
            min-height: 360px;
        }

        .chart-card {
            min-height: 260px;
        }

        @media(max-width:768px) {

            .map-card,
            .chart-card {
                min-height: auto;
            }
        }

        #noticeCarousel .carousel-item {
            height: 35px;
        }

        .animate-pulse {
            background-color: var(--primeColor) !important;
            animation: pulse-blue 2s infinite;
        }

        @keyframes pulse-blue {
            0% {
                box-shadow: 0 0 0 0 rgba(31, 81, 138, 0.4);
            }

            70% {
                box-shadow: 0 0 0 8px rgba(31, 81, 138, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(31, 81, 138, 0);
            }
        }

        /* Vertical centering for carousel content */
        .carousel-inner .d-flex {
            height: 100%;
        }

        #noticeCarousel .fa-chevron-left,
        #noticeCarousel .fa-chevron-right {
            font-size: 12px;
            cursor: pointer;
            opacity: 0.5;
        }

        #noticeCarousel .fa-chevron-left:hover,
        #noticeCarousel .fa-chevron-right:hover {
            opacity: 1;
            color: var(--primeColor);
        }

        .notify-dot {
            position: absolute;
            top: 5px;
            right: 5px;
            width: 8px;
            height: 8px;
            background: red;
            border-radius: 50%;
        }
    </style>


    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- SVG Map (inline, no external dependency) -->
    <script src="https://www.gstatic.com/charts/loader.js"></script>

</head>

<body>
    <!-- ===== GOV HEADER & NAVBAR (DYNAMIC & RESPONSIVE) ===== -->
    <header class="gov-header sticky-top">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid">

                <!-- LEFT: LOGO + TITLE -->
                <div class="d-flex align-items-center">
                    <span class="gov-logo mr-2">🛡️</span>
                    <div class="d-none d-sm-block">
                        <div class="gov-title">Government of Uttar Pradesh</div>
                        <div class="gov-subtitle">Department of Health & Family Welfare</div>
                    </div>
                </div>

                <!-- MOBILE TOGGLE -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#govNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- NAV + ACTIONS -->
                <div class="collapse navbar-collapse" id="govNav">

                    <!-- CENTER MENU -->
                    <ul class="navbar-nav mx-auto gov-menu">
                        <li class="nav-item"><a
                                class="nav-link <?php if (isset($url2) && $url2 == 'dashboard') { ?>active<?php } ?>"
                                href="<?php print base_url(); ?>user/dashboard">Analytics</a></li>
                        <li class="nav-item"><a
                                class="nav-link <?php if (isset($url2) && $url2 == 'new_screening') { ?>active<?php } ?>"
                                href="<?php print base_url(); ?>user/new_screening">New Screening</a></li>
                        <li class="nav-item"><a
                                class="nav-link <?php if (isset($url2) && $url2 == 'report') { ?>active<?php } ?>"
                                href="<?php print base_url(); ?>user/reports">Reports</a></li>
                    </ul>

                    <!-- RIGHT ACTIONS -->
                    <ul class="navbar-nav ml-auto align-items-center">
                        <!-- NOTIFICATION DROPDOWN -->
     <li class="nav-item dropdown mr-3">
    <a class="nav-link dropdown-toggle position-relative" href="#" data-toggle="dropdown">
        <i class="fa fa-bell"></i>

        <?php if (!empty($notification['project']) || !empty($notification['last'])): ?>
            <span class="notify-dot"></span>
        <?php endif; ?>
    </a>

    <div class="dropdown-menu dropdown-menu-right gov-dropdown shadow-sm">
        <h6 class="dropdown-header">
            <i class="fa fa-bell mr-1 text-primary"></i> Notifications
        </h6>

        <!-- ACTIVE CAMP -->
        <?php if (!empty($notification['project'])): ?>
            <a class="dropdown-item small d-flex align-items-center" href="#">
                <i class="fa fa-map-marker-alt text-success mr-2"></i>
                <span>
                    Active Camp:
                    <strong><?= $notification['project']->project_name ?></strong>
                </span>
            </a>
        <?php endif; ?>

        <!-- LAST PATIENT -->
        <?php if (!empty($notification['last'])): ?>
            <a class="dropdown-item small d-flex align-items-center" href="#">
                <i class="fa fa-user text-info mr-2"></i>
                <span>
                    Last Patient:
                    <strong><?= $notification['last']->first_name ?></strong>
                </span>
            </a>
        <?php endif; ?>

        <!-- EMPTY -->
        <?php if (empty($notification['project']) && empty($notification['last'])): ?>
            <span class="dropdown-item small text-muted">
                <i class="fa fa-info-circle mr-1"></i> No notifications
            </span>
        <?php endif; ?>
    </div>
</li>

                        <!-- USER DROPDOWN -->
                        <?php
                        $username = $this->session->userdata('username');
                        $role = $this->session->userdata('admin_role');

                        // initials (first 2 letters)
                        $initials = strtoupper(substr($username, 0, 2));
                        ?>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#"
                                data-toggle="dropdown">

                                <!-- USER CIRCLE -->
                                <div class="gov-user-circle mr-2"><?= $initials ?></div>

                                <!-- USER NAME -->
                                <span class="d-none d-md-inline"><?= $username ?></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right gov-dropdown">

                                <!-- USER INFO -->
                                <div class="px-3 py-2 small text-muted">
                                    Username: <?= $username ?><br>
                                    Role: <?= $role ?>
                                </div>

                                <div class="dropdown-divider"></div>

                                <!-- PROFILE -->
                                <a class="dropdown-item" href="<?= base_url('user/profile') ?>">
                                    <i class="fa fa-user text-primary mr-2"></i> Profile
                                </a>

                                <!-- CHANGE PASSWORD -->
                                <a class="dropdown-item" href="<?= base_url('user/profile/password') ?>">
                                    <i class="fa fa-key text-warning mr-2"></i> Change Password
                                </a>

                                <div class="dropdown-divider"></div>

                                <!-- LOGOUT -->
                                <a class="dropdown-item text-danger" href="<?= base_url('user/auth/logout') ?>">
                                    <i class="fa fa-sign-out mr-2"></i> Logout
                                </a>

                            </div>
                        </li>

                    </ul>
                </div>

            </div>
        </nav>
    </header>

    <!-- ===== NOTIFICATION BAR ===== -->
    <div class="container-fluid py-2 bg-white border-bottom shadow-sm">
        <?php if (!empty($notices)): ?>
            <div id="noticeCarousel" class="carousel slide" data-ride="carousel" data-interval="5000">
                <div class="carousel-inner">
                    <?php $i = 0;
                    foreach ($notices as $n): ?>
                        <div class="carousel-item <?= ($i == 0) ? 'active' : '' ?>">
                            <div class="d-flex align-items-center justify-content-between px-md-5">

                                <div class="d-flex align-items-center overflow-hidden">
                                    <span class="badge badge-primary rounded-pill mr-3 px-3 py-1 animate-pulse">
                                        <i class="fa fa-bullhorn mr-1"></i> UPDATE
                                    </span>
                                    <span class="text-truncate font-weight-bold text-dark" style="max-width: 600px;">
                                        <?= $n->message ?>
                                    </span>
                                    <span class="badge badge-light border ml-3 d-none d-md-inline-block text-muted">
                                        Ends: <?= date('d M Y', strtotime($n->valid_till)) ?>
                                    </span>
                                </div>

                                <div class="d-flex align-items-center">
                                    <?php if (!empty($n->file)): ?>
                                        <a href="<?= base_url('uploads/notices/' . $n->file) ?>" target="_blank"
                                            class="notice-link mr-3">
                                            View Circular <i class="fa fa-external-link small"></i>
                                        </a>
                                    <?php endif; ?>

                                    <?php if (count($notices) > 1): ?>
                                        <div class="btn-group border-left pl-3">
                                            <a href="#noticeCarousel" role="button" data-slide="prev" class="text-muted mr-2">
                                                <i class="fa fa-chevron-left"></i>
                                            </a>
                                            <a href="#noticeCarousel" role="button" data-slide="next" class="text-muted">
                                                <i class="fa fa-chevron-right"></i>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>

                            </div>
                        </div>
                        <?php $i++; endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>


    <div class="main-wrapper">