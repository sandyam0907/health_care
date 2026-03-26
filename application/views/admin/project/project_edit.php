<div class="content-wrapper">
  <section class="content">

    <!-- Messages -->
    <?php $this->load->view('admin/includes/_messages.php') ?>

    <div class="card">

      <div class="card-header">
        <div class="d-inline-block">
          <h3 class="card-title">
            <i class="fa fa-pencil"></i>&nbsp; Edit Project
          </h3>
        </div>

        <div class="d-inline-block float-right">
          <a href="<?= base_url('admin/project'); ?>" class="btn btn-success">
            <i class="fa fa-list"></i> Project List
          </a>

          <?php if($this->rbac->check_operation_permission('add')): ?>
            <a href="<?= base_url('admin/project/project_add'); ?>" class="btn btn-success">
              <i class="fa fa-plus"></i> Add New Project
            </a>
          <?php endif; ?>
        </div>
      </div>

      <div class="card-body">

        <?php echo validation_errors(); ?>

        <?php echo form_open(base_url('admin/project/project_edit/'.$project['id']), 'class="form-horizontal"'); ?>

        <!-- PROJECT NAME -->
        <div class="form-group">
          <label class="col-sm-2 control-label">Project Name</label>
          <div class="col-sm-12">
            <input type="text" name="project"
                   value="<?= $project['project_name']; ?>"
                   class="form-control"
                   placeholder="Project Name">
          </div>
        </div>

        <!-- STATUS -->
        <div class="form-group">
          <label class="col-sm-2 control-label">Status</label>
          <div class="col-sm-12">
            <select name="status" class="form-control">
              <option value="">Select Status</option>
              <option value="1" <?= ($project['status'] == 1)?'selected':'' ?>>Active</option>
              <option value="0" <?= ($project['status'] == 0)?'selected':'' ?>>Inactive</option>
            </select>
          </div>
        </div>

        <!-- SUBMIT -->
        <div class="form-group">
          <div class="col-md-12">
            <input type="submit" name="submit" value="Update Project" class="btn btn-primary pull-right">
          </div>
        </div>

        <?php echo form_close(); ?>

      </div>
    </div>

  </section>
</div>

<script>
  $("#project").addClass('active');
</script>