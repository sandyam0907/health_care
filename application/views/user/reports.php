<!-- Datatable style -->
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.css">
<style>
    @media (max-width: 768px) {

        .page-title {
            font-size: 16px;
        }

        .btn {
            font-size: 12px;
        }

        table {
            font-size: 13px;
        }

    }

    /* keep your layout css */
    td .flex {
        display: flex;
        justify-content: center;
        gap: 6px;
    }

    td .flex .btn {
        padding: 3px 8px !important;
        min-width: auto !important;
    }

/* Match icon color with outline button color */
.btn-outline-primary i { color: #007bff; }
.btn-outline-danger i { color: #dc3545; }
.btn-outline-success i { color: #28a745; }
.btn-outline-info i { color: #17a2b8; }
.btn-outline-warning i { color: #ffc107; }

/* Change icon color to white on hover */
.btn-outline-primary:hover i,
.btn-outline-danger:hover i,
.btn-outline-success:hover i,
.btn-outline-info:hover i,
.btn-outline-warning:hover i {
    color: #fff;
}

/* Smooth hover effect */
.flex .btn {
    transition: all 0.2s ease-in-out;
}
   

    .btn {
        white-space: nowrap;
    }

    .reset-btn ,i {
        white-space: nowrap;
    }

    .qrbox {
        width: 60px;
        height: 60px;
    }

    /* ===== DATATABLE HEADER ===== */
    #reportsTable thead th {
        background: #1f518a;
        color: #fff;
        font-weight: 600;
        text-align: center;
    }

    /* ===== TABLE ROW HOVER ===== */
    #reportsTable tbody tr:hover {
        background: #f2f7ff;
    }

    /* ===== SEARCH BOX ===== */
    .dataTables_filter input {
        border: 1px solid #1f518a;
        border-radius: 4px;
        padding: 5px 8px;
        outline: none;
    }

    /* ===== SHOW ENTRIES DROPDOWN ===== */
    .dataTables_length select {
        border: 1px solid #1f518a;
        border-radius: 4px;
        padding: 4px;
    }

    /* ===== PAGINATION ===== */
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border: 1px solid #1f518a !important;
        background: #fff !important;
        color: #1f518a !important;
        padding: 5px 10px;
        margin: 2px;
        border-radius: 4px;
    }

    /* ACTIVE PAGE */
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: #1f518a !important;
        color: #fff !important;
    }

    /* HOVER */
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: #1f518a !important;
        color: #fff !important;
    }

    /* ALIGN DATATABLE TOP CONTROLS */
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter {
        margin-bottom: 10px;
    }
    #qrCode img {
    width: 260px !important;
    height: 260px !important;
    margin: auto;
    display: block;
}
</style>
<!-- ===== BREADCRUMB BAR ===== -->
<div class="container-fluid">
    <nav aria-label="breadcrumb" class="mt-2">
        <ol class="breadcrumb bg-white shadow-sm mb-0" style="border-left:4px solid #1f518a;">
            <li class="breadcrumb-item">
                <a href="index.html">Dashboard</a>
            </li>

            <li class="breadcrumb-item active" aria-current="page">
                Report
            </li>
        </ol>
    </nav>
</div>

<div class="container-fluid mt-4 ">

    <!-- ===== FILTER BAR ===== -->
    <div class="card p-3 mb-4 shadow-sm">
        <div class="row align-items-end">

            <!-- DATE RANGE -->
            <div class="col-md-3 col-sm-6 mb-2">
                <label class="small font-weight-bold">Date Range</label>
                <input type="date" id="from_date" class="form-control" placeholder="From">
            </div>

            <div class="col-md-3 col-sm-6 mb-2">
                <label class="small font-weight-bold">To</label>
                <input type="date" id="to_date" class="form-control">
            </div>

            <!-- DISTRICT -->
            <div class="col-md-3 col-sm-6 mb-2">
                <label class="small font-weight-bold">District</label>
                <select id="district" class="form-control">
                    <option value="">All Districts</option>
                    <?php foreach ($districts as $d): ?>
                        <option value="<?= $d->id ?>">
                            <?= $d->district_name ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- CAMP STATUS -->
            <div class="col-md-3 col-sm-6 mb-2">
                <label class="small font-weight-bold">Status</label>
                <select id="status" class="form-control">
                    <option value="">All</option>
                    <option value="1">Completed</option>
                    <option value="0">Pending</option>
                </select>
            </div>

        </div>

        <!-- ADVANCED FILTER ROW -->
        <div class="row mt-3">

            <!-- KEYWORD -->
            <div class="col-md-3 col-sm-6 mb-2">
                <input type="text" id="keyword" class="form-control"
                    placeholder="Search by Patient ID / Camp ID / Mobile">
            </div>

            <!-- CAMP TYPE -->
            <div class="col-md-3 col-sm-6 mb-2">
                <select id="camp_type" name="camp_type" class="form-control">
                    <option value="">Camp Type</option>

                    <?php foreach ($camp_types as $c): ?>
                        <option value="<?= $c->id ?>" <?= set_select('camp_type', $c->id) ?>>
                            <?= $c->project_name ?>
                        </option>
                    <?php endforeach; ?>

                </select>
            </div>

            <!-- RESET -->
            <div class="col-md-3 col-sm-12 mb-2">
                <div class="d-flex flex-column flex-md-row align-items-center">

                    <button class="btn btn-outline-secondary btn-sm mr-md-2 mb-2 mb-md-0 reset-btn">
                        <i class="fa fa-refresh"></i> Reset
                    </button>

                    <button class="btn btn-primary btn-sm">
                        Apply
                    </button>

                </div>
            </div>
        </div>
    </div>
</div>


</div>
</div>

</div>

<!-- ===== MAIN CONTENT ===== -->
<div class="container-fluid ">
    <div class="card shadow-sm">
        <div class="card-body">

            <div class="d-flex justify-content-between mb-3">
                <h5 class="page-title">
                    <i class="bi bi-file-earmark-medical"></i> Generated Health Reports
                </h5>
                <a href="<?= base_url('user/new_screening') ?>" class="btn btn-primary btn-sm">
                    <i class="fa fa-plus-circle"></i> New Screening
                </a>
            </div>
            <div class="table-responsive">
                <table id="reportsTable" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Report ID</th>
                            <th>Patient Name</th>
                            <th>Age / Gender</th>
                            <th>District</th>
                            <th>Camp Date</th>
                            <th>Status</th>
                            <th width="220">Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<!-- QR Code Modal -->
<div class="modal fade" id="qrModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">
                    <i class="fa fa-qrcode"></i> Scan QR Code
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    &times;
                </button>
            </div>
            <div class="modal-body">
                <div id="qrCode"></div>
                <p class="mt-2 text-muted small">
                    Scan to download the report
                </p>
            </div>
        </div>
    </div>
</div>
<script>
    var csrfName = '<?= $this->security->get_csrf_token_name(); ?>';
    var csrfHash = '<?= $this->security->get_csrf_hash(); ?>';
</script>