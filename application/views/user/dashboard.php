<style>
    .district-progress {
        height: 6px;
        border-radius: 10px;
        background-color: #f0f2f5;
    }

    .bg-district {
        background-color: #1f518a !important;
    }

    .text-district {
        color: #1f518a !important;
    }

    .card {
        border-radius: 14px;
        border: none;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06);
    }

    .stat-card {
        transition: 0.3s;
    }

    .stat-card:hover {
        transform: translateY(-5px);
    }

    .stat-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: rgba(0, 0, 0, 0.05);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .stat-icon i {
        font-size: 16px;
        color: inherit;
    }

    .card-header {
        font-size: 14px;
        font-weight: 600;
        background: #fff;
        border-bottom: 1px solid #f1f1f1;
    }

    canvas {
        max-height: 250px;
    }

    .chart-row {
        margin-top: 20px;
    }

    .chart-card {
        padding: 5px;
        transition: 0.2s;
    }

    .chart-card:hover {
        transform: translateY(-3px);
    }

    .custom-scroll {
        scrollbar-width: thin;
    }

    .custom-scroll::-webkit-scrollbar {
        width: 6px;
    }

    .custom-scroll::-webkit-scrollbar-thumb {
        background: #ccc;
        border-radius: 10px;
    }
</style>

<div class="container-fluid mt-4 mb-5">

    <!-- ===== BREADCRUMB ===== -->
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb bg-white shadow-sm mb-0" style="border-left:4px solid #1f518a;">
            <li class="breadcrumb-item active">
                <i class="fa fa-bar-chart text-primary mr-1"></i> Analytics Dashboard
            </li>
        </ol>
    </nav>

    <!-- ===== FILTER ===== -->
    <div class="card p-3 mb-4">
        <div class="row">

            <div class="col-md-3 col-sm-6 mb-2">
                <label class="small fw-bold">Date Range</label>
                <input type="date" id="from_date" class="form-control">
            </div>

            <div class="col-md-3 col-sm-6 mb-2">
                <label class="small fw-bold">To</label>
                <input type="date" id="to_date" class="form-control">
            </div>

            <div class="col-md-3 col-sm-6 mb-2">
                <label class="small fw-bold">District</label>
                <select id="district" class="form-control">
                    <option value="">All</option>
                    <?php foreach ($districts as $d): ?>
                        <option value="<?= $d->id ?>"><?= $d->district_name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-3 col-sm-6 mb-2">
                <label class="small fw-bold">Status</label>
                <select id="status" class="form-control">
                    <option value="">All</option>
                    <option value="1">Completed</option>
                    <option value="0">Pending</option>
                </select>
            </div>

        </div>

        <div class="row mt-2">

            <div class="col-md-3 col-sm-6 mb-2 ">
                <select id="camp_type" class="form-control">
                    <option value="">Camp Type</option>
                    <?php foreach ($camp_types as $c): ?>
                        <option value="<?= $c->id ?>"><?= $c->project_name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- <div class="col-md-3 col-sm-6 mb-2 d-flex flex-wrap gap-2">
                <button class="btn btn-outline-secondary btn-sm reset-btn">
                    <i class="fa fa-refresh"></i> Reset
                </button>
                <button class="btn btn-primary btn-sm">Apply</button>
            </div> -->

             <div class="col-md-3 col-sm-12 mb-2">
                <div class="d-flex flex-column flex-md-row align-items-center">
                    <button class="btn btn-outline-secondary btn-sm mr-md-2 mb-2 mb-md-0 reset-btn">
                        <i class="fa fa-refresh"></i> Reset
                    </button>
                    <button class="btn btn-primary btn-sm">Apply</button>
                </div>
            </div>


        </div>
    </div>

    <!-- ===== SUMMARY ===== -->
    <div class="row">

        <!-- 1. Screenings -->
        <div class="col-md-3 col-6 mb-3">
            <div class="card stat-card p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small>Total Screenings</small>
                        <h4 class="text-primary mb-0"><?= $total_screenings ?></h4>
                    </div>
                    <div class="stat-icon text-primary">
                        <i class="fa fa-file-text"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2. Camps -->
        <div class="col-md-3 col-6 mb-3">
            <div class="card stat-card p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small>Total Camps</small>
                        <h4 class="text-success mb-0"><?= $total_camps ?></h4>
                    </div>
                    <div class="stat-icon text-success">
                        <i class="fa fa-tree"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- 3. Patients -->
        <div class="col-md-3 col-6 mb-3">
            <div class="card stat-card p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small>Total Patients</small>
                        <h4 class="text-info mb-0"><?= $total_patients ?></h4>
                    </div>
                    <div class="stat-icon text-info">
                        <i class="fa fa-users"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- 4. Today -->
        <div class="col-md-3 col-6 mb-3">
            <div class="card stat-card p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small>Today</small>
                        <h4 class="text-warning mb-0"><?= $today ?></h4>
                    </div>
                    <div class="stat-icon text-warning">
                        <i class="fa fa-calendar"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- ===== CHARTS ===== -->

    <!-- ROW 1 -->
    <div class="row chart-row">

        <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
            <div class="card chart-card h-100">
                <div class="card-header">Gender Distribution</div>
                <div class="card-body">
                    <canvas id="genderChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
            <div class="card chart-card h-100">
                <div class="card-header">Age Group</div>
                <div class="card-body">
                    <canvas id="ageChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
            <div class="card chart-card h-100">

                <!-- HEADER -->
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>District Performance</span>
                    <select id="districtPerformanceFilter" class="form-control form-control-sm" style="width:150px;">
                        <option value="">Select</option>
                        <?php foreach ($districts as $d): ?>
                            <option value="<?= $d->id ?>"><?= $d->district_name ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- BODY -->
                <div class="card-body p-3 custom-scroll" style="max-height:350px;" id="districtPerformanceContainer">
                    <?php
                    if (!empty($_GET['district'])) {
                        $data_to_show = $district_wise;
                    } else {
                        $data_to_show = array_slice($district_wise, 0, 5);
                    }
                    $max_total = !empty($data_to_show) ? max(array_column($data_to_show, 'total')) : 1;
                    foreach ($data_to_show as $dw):
                        $percent = ($dw->total / $max_total) * 100;
                        ?>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-1">
                                <span class="small fw-bold"><?= $dw->district_name ?></span>
                                <span class="small fw-bold text-district"><?= $dw->total ?></span>
                            </div>
                            <div class="progress district-progress">
                                <div class="progress-bar bg-district" style="width: <?= $percent ?>%"></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

            </div>
        </div>

    </div>

    <!-- ROW 2 -->
    <div class="row chart-row">

        <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
            <div class="card chart-card h-100">
                <div class="card-header">Report Status</div>
                <div class="card-body text-center">
                    <canvas id="statusChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-8 col-md-6 col-sm-12 mb-3">
            <div class="card chart-card h-100">
                <div class="card-header">Top Districts</div>
                <div class="card-body">
                    <canvas id="districtChart"></canvas>
                </div>
            </div>
        </div>

    </div>

    <!-- ROW 3 -->
    <div class="row chart-row">
        <div class="col-12 mb-3">
            <div class="card chart-card h-100">
                <div class="card-header">Daily Trend Analysis</div>
                <div class="card-body">
                    <canvas id="trendChart"></canvas>
                </div>
            </div>
        </div>
    </div>

</div>