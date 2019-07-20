<?php require APPROOT . '/views/includes/header.php'; ?>
    <a href="<?php echo URLROOT; ?>" class="btn btn-danger"><i class="fa fa-backward" aria-hidden="true"></i> Back</a>
    <div class="card card-body bg-light mt-5">
        <h2>Add Tweet</h2>
        <p>Create a Tweet with this form</p>
        <form action="<?php echo URLROOT; ?>/tweetes/create" method="post">
            <div class="form-group">
                <label>Title:<sup>*</sup></label>
                <input type="text" name="title" class="form-control form-control-lg <?php echo (!empty($data['title_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['title']; ?>" placeholder="Add a title...">
                <span class="invalid-feedback"><?php echo $data['title_error']; ?></span>
            </div>
            <div class="form-group">
                <label>Content:<sup>*</sup></label>
                <textarea name="content" class="form-control form-control-lg <?php echo (!empty($data['content_error'])) ? 'is-invalid' : ''; ?>" placeholder="Add some text..."><?php echo $data['content']; ?></textarea>
                <span class="invalid-feedback"><?php echo $data['content_error']; ?></span>
            </div>
            <input type="submit" class="btn btn-success" value="Submit">
        </form>
    </div>
<?php require APPROOT . '/views/includes/footer.php'; ?>