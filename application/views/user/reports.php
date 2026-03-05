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
                        <option value="<?= $d->district_name ?>">
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
            <<div class="col-md-3 col-sm-6 mb-2">
                <input type="text" id="keyword" class="form-control" placeholder="Search by Patient ID / Mobile">
        </div>

        <!-- CAMP TYPE -->
        <div class="col-md-3 col-sm-6 mb-2">
            <select id="camp_type" class="form-control">
                <option value="">Camp Type</option>
                <option>General Screening</option>
                <option>Lab Screening</option>
                <option>Specialty Camp</option>
            </select>
        </div>

        <!-- RESET -->
        <div class="col-md-3 col-sm-6 mb-2 flex" style="display: flex; gap: 10px;">
            <button id="resetFilter" class="btn btn-outline-secondary">
                ♻ Reset Filters
            </button>
            <button id="applyFilter"  class="btn btn-primary">
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
<div class="container-fluid mt-4 mb-4">
    <div class="card shadow-sm">
        <div class="card-body">

            <div class="d-flex justify-content-between mb-3">
                <h5 class="page-title">
                    <i class="bi bi-file-earmark-medical"></i> Generated Health Reports
                </h5>
                <button class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-circle"></i> New Screening
                </button>
            </div>

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



<script>
    $(function () {

        $('#reportsTable').DataTable({
            data: [
                {
                    id: 'UPH-2025-001',
                    name: 'Rahul Kumar',
                    age: '34 / Male',
                    district: 'Lucknow',
                    date: '25-Dec-2025',
                    status: 'Completed'
                },
                {
                    id: 'UPH-2025-002',
                    name: 'Sunita Devi',
                    age: '29 / Female',
                    district: 'Kanpur',
                    date: '25-Dec-2025',
                    status: 'Completed'
                },
                {
                    id: 'UPH-2025-003',
                    name: 'Amit Singh',
                    age: '45 / Male',
                    district: 'Varanasi',
                    date: '26-Dec-2025',
                    status: 'Pending'
                }
            ],
            columns: [
                { data: 'id' },
                { data: 'name' },
                { data: 'age' },
                { data: 'district' },
                { data: 'date' },
                {
                    data: 'status',
                    render: s => s === 'Completed'
                        ? '<span class="badge badge-success badge-status">Completed</span>'
                        : '<span class="badge badge-warning badge-status">Pending</span>'
                },
                {
                    data: null,
                    render: () => `
                    <div class="flex">
                        <button class="btn btn-sm"><i class="bi bi-eye"></i></button>
                        <button class="btn btn-sm"><i class="bi bi-file-earmark-pdf"></i></button>
                        <button class="btn btn-sm"><i class="bi bi-pencil"></i></button>
                    </div>
                `
                }
            ]
        });

    });
</script>