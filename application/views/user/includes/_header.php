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
    <link rel="stylesheet" href="<?= base_url()?>assets/dist/css/bootstrap.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <style>
        :root {
            --primeColor: #1f518a;
        }

        body {
            background: #f4f6f9;
            font-family: "Segoe UI", Roboto, Arial, sans-serif;
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
		.newscreening .card{
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

        /* ACTIVE TAB */
        .nav-tabs .nav-link.active {
            background: var(--primeColor);
            color: #fff;
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
                        <li class="nav-item"><a class="nav-link <?php if(isset($url2) && $url2=='dashboard'){?>active<?php }?>" href="<?php print base_url();?>user/dashboard">Analytics</a></li>
                        <li class="nav-item"><a class="nav-link <?php if(isset($url2) && $url2=='new_screening'){?>active<?php }?>" href="<?php print base_url();?>user/new_screening">New Screening</a></li>
                        <li class="nav-item"><a class="nav-link <?php if(isset($url2) && $url2=='report'){?>active<?php }?>" href="<?php print base_url();?>user/report">Reports</a></li>
                    </ul>

                    <!-- RIGHT ACTIONS -->
                    <ul class="navbar-nav ml-auto align-items-center">

                        <!-- NOTIFICATION DROPDOWN -->
                        <li class="nav-item dropdown mr-3">
                            <a class="nav-link dropdown-toggle position-relative" href="#" data-toggle="dropdown">
                                🔔
                                <span class="notify-dot"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right gov-dropdown">
                                <h6 class="dropdown-header">Notifications</h6>
                                <a class="dropdown-item small" href="#">🧪 Lab results pending</a>
                                <a class="dropdown-item small" href="#">📄 Report generated</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-center small" href="#">View all</a>
                            </div>
                        </li>

                        <!-- USER DROPDOWN -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#"
                                data-toggle="dropdown">
                                <div class="gov-user-circle mr-2">MO</div>
                                <span class="d-none d-md-inline">Medical Officer</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right gov-dropdown">
                                <div class="px-3 py-2 small text-muted">
                                    District Hospital<br>
                                    Role: Medical Officer
                                </div>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">👤 Profile</a>
                                <a class="dropdown-item" href="#">🔑 Change Password</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="login.html">🚪 Logout</a>
                            </div>
                        </li>

                    </ul>
                </div>

            </div>
        </nav>
    </header>

    <!-- ===== NOTIFICATION BAR ===== -->
    <div class="container-fluid px-0">
        <div class="alert alert-info mb-0 rounded-0 d-flex align-items-center justify-content-between"
            style="background:#e8f1fb;border-left:5px solid #1f518a;">
            <div>
                <strong>📢 Notice:</strong>
                Monthly health screening data submission deadline is
                <strong>30 September 2026</strong>.
            </div>
            <a href="#" class="small font-weight-bold text-primary">
                View Circular
            </a>
        </div>
    </div>

 
