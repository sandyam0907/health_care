<div class="content-wrapper">
  <section class="content">

    <div class="card">
      <div class="card-header">
        <div class="d-inline-block">
          <h3 class="card-title">
            <i class="fa fa-pencil"></i>&nbsp; Edit Taluk
          </h3>
        </div>

        <div class="d-inline-block float-right">
          <?php if($this->rbac->check_operation_permission('taluk_add')): ?>
            <a href="<?= base_url('admin/location/taluk/add'); ?>" class="btn btn-success">
              <i class="fa fa-plus"></i> Add New Taluk
            </a>
          <?php endif; ?>
        </div>
      </div>

      <div class="card-body">
        <?php echo validation_errors(); ?>           

        <?php echo form_open(base_url('admin/location/taluk/edit/'.$taluk['id']), 'class="form-horizontal"'); ?> 

          <div class="form-group">
            <label class="col-sm-3 control-label">Taluk Name</label>
            <div class="col-sm-12">
              <input type="text" name="taluk" class="form-control"
                     value="<?= $taluk['taluk_name']; ?>"
                     placeholder="Taluk name" required>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label">Status</label>
            <div class="col-sm-12">
              <select name="status" class="form-control">
                <option value="1" <?= ($taluk['status']==1)?'selected':''; ?>>Active</option>
                <option value="0" <?= ($taluk['status']==0)?'selected':''; ?>>Inactive</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-12">
              <input type="submit" name="submit" value="Update Taluk" class="btn btn-primary pull-right">
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