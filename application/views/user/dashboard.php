

    <div class="container-fluid mt-4 mb-5">
   <!-- ===== BREADCRUMB BAR ===== -->
    <div class="container-fluid">
        <nav aria-label="breadcrumb" class="mt-2">
            <ol class="breadcrumb bg-white shadow-sm mb-0" style="border-left:4px solid #1f518a;">
                <li class="breadcrumb-item active" aria-current="page">
                    Analytics
                </li>
            </ol>
        </nav>
    </div>
        <!-- ===== FILTER BAR ===== -->
        <div class="card p-3 mb-4 shadow-sm">
            <div class="row align-items-end">

                <!-- DATE RANGE -->
                <div class="col-md-3 col-sm-6 mb-2">
                    <label class="small font-weight-bold">Date Range</label>
                    <input type="date" class="form-control" placeholder="From">
                </div>

                <div class="col-md-3 col-sm-6 mb-2">
                    <label class="small font-weight-bold">To</label>
                    <input type="date" class="form-control">
                </div>

                <!-- DISTRICT -->
                <div class="col-md-3 col-sm-6 mb-2">
                    <label class="small font-weight-bold">District</label>
                    <select class="form-control">
                        <option value="">All Districts</option>
                        <option>Lucknow</option>
                        <option>Kanpur</option>
                        <option>Varanasi</option>
                        <option>Agra</option>
                        <option>Gorakhpur</option>
                    </select>
                </div>

                <!-- CAMP STATUS -->
                <div class="col-md-3 col-sm-6 mb-2">
                    <label class="small font-weight-bold">Status</label>
                    <select class="form-control">
                        <option value="">All</option>
                        <option>Completed</option>
                        <option>Pending</option>
                        <option>Abnormal</option>
                    </select>
                </div>

            </div>

            <!-- ADVANCED FILTER ROW -->
            <div class="row mt-3">

                <!-- KEYWORD -->
                <div class="col-md-3 col-sm-6 mb-2">
                    <input type="text" class="form-control" placeholder="Search by Patient ID / Camp ID / Mobile">
                </div>

                <!-- CAMP TYPE -->
                <div class="col-md-3 col-sm-6 mb-2">
                    <select class="form-control">
                        <option value="">Camp Type</option>
                        <option>General Screening</option>
                        <option>Lab Screening</option>
                        <option>Specialty Camp</option>
                    </select>
                </div>

                <!-- RESET -->
                <div class="col-md-3 col-sm-6 mb-2 flex" style="display: flex; gap: 10px;">
                    <button class="btn btn-outline-secondary">
                        ♻ Reset Filters
                    </button>
                    <button class="btn btn-primary">
                        Apply
                    </button>
                </div>

                <!-- ACTIONS -->
                <div class="col-md-3 col-sm-12 mb-2 text-right">

                </div>

            </div>
        </div>

    </div>


    <!-- ===== MAIN CONTENT ===== -->
    <div class="container-fluid mt-4 mb-5">



        <!-- SUMMARY -->
        <div class="row mb-4">
            <div class="col-md-3 col-6 mb-3">
                <div class="card stat-card text-center p-3">
                    <h6>Total Screenings</h6>
                    <h3 class="text-primary">12,450</h3>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-3">
                <div class="card stat-card text-center p-3">
                    <h6>Total Camps</h6>
                    <h3 class="text-success">320</h3>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-3">
                <div class="card stat-card text-center p-3">
                    <h6>Abnormal Reports</h6>
                    <h3 class="text-danger">1,245</h3>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-3">
                <div class="card stat-card text-center p-3">
                    <h6>Pending</h6>
                    <h3 class="text-warning">184</h3>
                </div>
            </div>
        </div>

        <!-- MAP + CHARTS -->
        <!-- MAP + CHARTS -->
        <div class="row">

            <!-- BIG UP MAP (FULL WIDTH) -->
            <div class="col-4 mb-4">
                <div class="card p-3 position-relative map-card">
                    <h6 class="section-title mb-3">
                        Uttar Pradesh – District Health Overview
                        <small class="text-muted">(Hover to view)</small>
                    </h6>

                    <div id="map" style="width:100%; height:500px"></div>

                </div>
            </div>

            <!-- SECONDARY CHARTS -->
            <div class="col-md-4 mb-4">
                <div class="card p-3 chart-card">
                    <h6 class="section-title">Report Status Distribution</h6>
                    <canvas id="statusDonut"></canvas>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card p-3 chart-card">
                    <h6 class="section-title">Top Districts (Screenings)</h6>
                    <canvas id="districtBar"></canvas>
                </div>
            </div>

        </div>

    </div>


   