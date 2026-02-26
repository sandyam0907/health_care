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
          <i class="fa fa-list"></i>&nbsp; Taluk List
        </h3>
      </div>

      <div class="d-inline-block float-right">
        <a href="<?= base_url('admin/location/taluk/add'); ?>" class="btn btn-success">
          <i class="fa fa-plus"></i> Add New Taluk
        </a>
      </div>
    </div>

    <div class="card-body">
      <table id="na_datatable" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>No</th>
          <th>Taluk Name</th>
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
//---------------------------------------------------
var table = $('#na_datatable').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": "<?=base_url('admin/location/taluk_datatable_json')?>",
    "order": [[1,'asc']],
    "columnDefs": [
      { "targets": 0, "searchable":false, "orderable":true },
      { "targets": 1, "name": "taluk_name", "searchable":true, "orderable":true },
      { "targets": 2, "name": "status", "searchable":true, "orderable":true },
      { "targets": 3, "searchable":false, "orderable":false, "width":"100px" }
    ]
});
</script>

<script type="text/javascript">
$(document).ready(function(){
  $(".btn-delete").click(function(){
    if (!confirm("Do you want to delete")){
      return false;
    }
  });
});
</script>

<script>
$("#location").addClass('active');
</script>