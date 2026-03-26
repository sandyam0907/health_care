<div class="content-wrapper">
  <section class="content">

    <!-- Messages -->
    <?php $this->load->view('admin/includes/_messages.php') ?>

    <div class="card">

      <div class="card-header">
        <div class="d-inline-block">
          <h3 class="card-title">
            <i class="fa fa-plus"></i>&nbsp; Add New Project
          </h3>
        </div>

        <div class="d-inline-block float-right">
          <a href="<?= base_url('admin/project'); ?>" class="btn btn-success">
            <i class="fa fa-list"></i> Project List
          </a>
        </div>
      </div>

      <!-- CARD BODY -->
      <div class="card-body">

        <?php echo validation_errors(); ?>

        <?php echo form_open(base_url('admin/project/project_add'), 'class="form-horizontal"'); ?>

        <!-- PROJECT NAME -->
        <div class="form-group">
          <label class="col-sm-3 control-label">Project Name</label>
          <div class="col-sm-12">
            <input type="text" name="project" class="form-control" placeholder="Enter Project Name">
          </div>
        </div>

        <!-- SUBMIT BUTTON -->
        <div class="form-group">
          <div class="col-md-12">
            <input type="submit" name="submit" value="Add Project" class="btn btn-primary pull-right">
          </div>
        </div>

        <?php echo form_close(); ?>

      </div>
    </div>

  </section>
</div>

<script>
  $("#project").addClass('active'); // highlight menu
</script>