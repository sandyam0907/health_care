<div class="content-wrapper">
    <section class="content">

        <!-- Messages -->
        <?php $this->load->view('admin/includes/_messages.php') ?>

        <div class="card">

            <div class="card-header">
                <div class="d-inline-block">
                    <h3 class="card-title">
                        <i class="fa fa-pencil"></i>&nbsp; Edit Notice
                    </h3>
                </div>

                <div class="d-inline-block float-right">
                    <a href="<?= base_url('admin/notice'); ?>" class="btn btn-success">
                        <i class="fa fa-list"></i> Notice List
                    </a>

                    <?php if ($this->rbac->check_operation_permission('add')): ?>
                        <a href="<?= base_url('admin/notice/notice_add'); ?>" class="btn btn-success">
                            <i class="fa fa-plus"></i> Add New Notice
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="card-body">

                <?php echo validation_errors(); ?>

                <?php echo form_open_multipart(base_url('admin/notice/notice_edit/'.$notice['id']), 'class="form-horizontal"'); ?>

                <!-- TITLE -->
                <div class="form-group">
                    <label class="col-sm-2 control-label">Title</label>
                    <div class="col-sm-12">
                        <input type="text" name="title" value="<?= $notice['title']; ?>" class="form-control"
                            placeholder="Notice Title">
                    </div>
                </div>

                <!-- MESSAGE -->
                <div class="form-group">
                    <label class="col-sm-2 control-label">Message</label>
                    <div class="col-sm-12">
                        <textarea name="message" class="form-control" rows="4"><?= $notice['message']; ?></textarea>
                    </div>
                </div>

                <!-- VALID TILL -->
                <div class="form-group">
                    <label class="col-sm-2 control-label">Valid Till</label>
                    <div class="col-sm-12">
                        <input type="date" name="valid_till" value="<?= $notice['valid_till']; ?>" class="form-control">
                    </div>
                </div>

                <!-- Circular File -->
                <div class="form-group">
                    <label class="col-sm-2 control-label">Upload Circular (PDF)</label>
                    <div class="col-sm-12">
                        <input type="file" name="file" class="form-control">

                        <?php if (!empty($notice['file'])): ?>
                            <p>
                                Current:
                                <a href="<?= base_url('uploads/notices/' . $notice['file']) ?>" target="_blank">
                                    View File
                                </a>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- STATUS -->
                <div class="form-group">
                    <label class="col-sm-2 control-label">Status</label>
                    <div class="col-sm-12">
                        <select name="status" class="form-control">
                            <option value="">Select Status</option>
                            <option value="1" <?= ($notice['status'] == 1) ? 'selected' : '' ?>>Active</option>
                            <option value="0" <?= ($notice['status'] == 0) ? 'selected' : '' ?>>Inactive</option>
                        </select>
                    </div>
                </div>

                <!-- SUBMIT -->
                <div class="form-group">
                    <div class="col-md-12">
                        <input type="submit" name="submit" value="Update Notice" class="btn btn-primary pull-right">
                    </div>
                </div>

                <?php echo form_close(); ?>

            </div>
        </div>

    </section>
</div>

<script>
    $("#notice").addClass('active');
</script>