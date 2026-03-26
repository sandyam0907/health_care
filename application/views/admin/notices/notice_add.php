<div class="content-wrapper">
  <section class="content">

    <!-- Messages -->
    <?php $this->load->view('admin/includes/_messages.php') ?>

    <div class="card">

      <div class="card-header">
        <div class="d-inline-block">
          <h3 class="card-title">
            <i class="fa fa-bullhorn"></i>&nbsp; Add New Notice
          </h3>
        </div>

        <div class="d-inline-block float-right">
          <a href="<?= base_url('admin/notice'); ?>" class="btn btn-success">
            <i class="fa fa-list"></i> Notice List
          </a>
        </div>
      </div>

      <!-- CARD BODY -->
      <div class="card-body">

        <?php echo validation_errors(); ?>

        <?php echo form_open_multipart(base_url('admin/notice/notice_add'), 'class="form-horizontal"'); ?>

        <!-- TITLE -->
        <div class="form-group">
          <label class="col-sm-3 control-label">Title</label>
          <div class="col-sm-12">
            <input type="text" name="title" class="form-control" placeholder="Enter Notice Title">
          </div>
        </div>

        <!-- MESSAGE -->
        <div class="form-group">
          <label class="col-sm-3 control-label">Message</label>
          <div class="col-sm-12">
            <textarea name="message" class="form-control" rows="4" placeholder="Enter Notice Message"></textarea>
          </div>
        </div>

        <!-- VALID TILL -->
        <div class="form-group">
          <label class="col-sm-3 control-label">Valid Till</label>
          <div class="col-sm-12">
            <input type="date" name="valid_till" class="form-control">
          </div>
        </div>

        <!-- Circular file -->
        <div class="form-group">
          <label class="col-sm-3 control-label">Upload Circular (PDF)</label>
          <div class="col-sm-12">
            <input type="file" name="file" class="form-control">
          </div>
        </div>

        <!-- SUBMIT -->
        <div class="form-group">
          <div class="col-md-12">
            <input type="submit" name="submit" value="Add Notice" class="btn btn-primary pull-right">
          </div>
        </div>

        <?php echo form_close(); ?>

      </div>
    </div>

  </section>
</div>

<script>
  $("#notice").addClass('active'); // highlight menu
</script>