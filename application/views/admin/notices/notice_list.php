<!-- Datatable style -->
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.css">

<div class="content-wrapper">
    <section class="content">

        <!-- Messages -->
        <?php $this->load->view('admin/includes/_messages.php') ?>

        <div class="card">

            <div class="card-header">
                <div class="d-inline-block">
                    <h3 class="card-title">
                        <i class="fa fa-bullhorn"></i>&nbsp; Notice List
                    </h3>
                </div>

                <div class="d-inline-block float-right">
                    <a href="<?= base_url('admin/notice/notice_add'); ?>" class="btn btn-success">
                        <i class="fa fa-plus"></i> Add New Notice
                    </a>
                </div>
            </div>

            <div class="card-body">
                <table id="notice_datatable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Title</th>
                            <th>Message</th>
                            <th>Valid Till</th>
                            <th>Status</th>
                            <th style="width: 150px;" class="text-right">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>

        </div>
    </section>
</div>


<!-- DataTables -->
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script>

<script>

    var table = $('#notice_datatable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "<?= base_url('admin/notice/notice_datatable_json') ?>",
        "order": [[1, 'asc']],
        "columnDefs": [
            { "targets": 0, "searchable": false, "orderable": true },
            { "targets": 1, "name": "title", "searchable": true, "orderable": true },
            { "targets": 2, "name": "message", "searchable": true, "orderable": false },
            { "targets": 3, "name": "valid_till", "searchable": true, "orderable": true },
            { "targets": 4, "name": "status", "searchable": true, "orderable": true },
            { "targets": 5, "searchable": false, "orderable": false, "width": "120px" }
        ]
    });
</script>

<script>
    $(document).ready(function () {
        $(".btn-delete").click(function () {
            if (!confirm("Do you want to delete")) {
                return false;
            }
        });
    });
</script>

<script>
    $("#notice").addClass('active'); // highlight menu
</script>