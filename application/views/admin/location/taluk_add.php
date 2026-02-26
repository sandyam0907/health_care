<div class="content-wrapper">
  <section class="content">

    <!-- Messages -->
    <?php $this->load->view('admin/includes/_messages.php') ?>

    <div class="card">
      <div class="card-header">
        <div class="d-inline-block">
          <h3 class="card-title">
            <i class="fa fa-plus"></i>&nbsp; Add New Taluk
          </h3>
        </div>

        <div class="d-inline-block float-right">
          <a href="<?= base_url('admin/location/taluk'); ?>" class="btn btn-success">
            <i class="fa fa-list"></i> Taluk List
          </a>
        </div>
      </div>

      <div class="card-body">
        <?php echo validation_errors(); ?>           

        <?php echo form_open(base_url('admin/location/taluk/add'), 'class="form-horizontal"'); ?> 

          <div class="form-group">
            <label class="col-sm-3 control-label">Taluk Name</label>
            <div class="col-sm-12">
              <input type="text" name="taluk" class="form-control" placeholder="Taluk name" required>
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-12">
              <input type="submit" name="submit" value="Add Taluk" class="btn btn-primary pull-right">
            </div>
          </div>

        <?php echo form_close(); ?>
      </div>
    </div>

  </section> 
</div>

<script>
  $("#location").addClass('active');
</script>