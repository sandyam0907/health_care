<!-- Datatable style -->
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.css">

<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/responsive.dataTables.min.css">
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

    /* icon colors before hover */
    .view-btn i {
        color: #007bff;
    }

    .pdf-btn i {
        color: #dc3545;
    }

    .edit-btn i {
        color: #ffc107;
    }

    /* icon on hover */
    .view-btn:hover i,
    .pdf-btn:hover i,
    .edit-btn:hover i {
        color: #fff;
    }

    .btn {
        white-space: nowrap;
    }

    .reset-btn{
    white-space: nowrap;
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

<div class="container-fluid mt-4 mb-5">

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
                <select id="camp_type" class="form-control">
                    <option value="">Camp Type</option>
                    <?php foreach ($projects as $p): ?>
                        <option value="<?= $p->project_name ?>">
                            <?= $p->project_name ?>
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
<!-- ACTIONS -->
<div class="col-md-3 col-sm-12 mb-2 text-right">

</div>

</div>
</div>

</div>

<!-- ===== MAIN CONTENT ===== -->
<div class="container-fluid mt-4 mb-4">
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
                            <th width="160">Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<script>
    var csrfName = '<?= $this->security->get_csrf_token_name(); ?>';
    var csrfHash = '<?= $this->security->get_csrf_hash(); ?>';
</script>
