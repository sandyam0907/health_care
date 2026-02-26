<div class="content-wrapper">
  <section class="content">

    <div class="card">
      <div class="card-header">
        <div class="d-inline-block">
          <h3 class="card-title">
            <i class="fa fa-pencil"></i>&nbsp; Edit District
          </h3>
        </div>

        <div class="d-inline-block float-right">
          <?php if($this->rbac->check_operation_permission('district_add')): ?>
            <a href="<?= base_url('admin/location/district/add'); ?>" class="btn btn-success">
              <i class="fa fa-plus"></i> Add New District
            </a>
          <?php endif; ?>
        </div>
      </div>

      <div class="card-body">
        <?php echo validation_errors(); ?>           

        <?php echo form_open(base_url('admin/location/district/edit/'.$district['id']), 'class="form-horizontal"'); ?> 

          <div class="form-group">
            <label class="col-sm-3 control-label">District Name</label>
            <div class="col-sm-12">
              <input type="text" name="district" class="form-control"
                     value="<?= $district['district_name']; ?>"
                     placeholder="District name" required>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label">Status</label>
            <div class="col-sm-12">
              <select name="status" class="form-control">
                <option value="1" <?= ($district['status']==1)?'selected':''; ?>>Active</option>
                <option value="0" <?= ($district['status']==0)?'selected':''; ?>>Inactive</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-12">
              <input type="submit" name="submit" value="Update District" class="btn btn-primary pull-right">
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