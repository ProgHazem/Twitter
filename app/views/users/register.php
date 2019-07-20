<?php require_once(APPROOT.'/views/includes/header.php'); ?>
<div class="row mb-5 ">
    <div class="col-md-6 mx-auto">
        <div class="card card-body bg-light mt-5">
            <h2>Create An Account</h2>
            <p>Please fill out this form to register with us</p>
            <form action="<?php echo URLROOT; ?>/users/register" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="fullname">FullName: <sup>*</sup></label>
                    <input type="text" name="fullname" class="form-control form-control-lg <?php echo (!empty($data['fullname_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['fullname']; ?>">
                    <span class="invalid-feedback"><?php echo $data['fullname_error']; ?></span>
                </div>
                <div class="form-group">
                    <label for="email">Email: <sup>*</sup></label>
                    <input type="email" name="email" class="form-control form-control-lg <?php echo (!empty($data['email_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>">
                    <span class="invalid-feedback"><?php echo $data['email_error']; ?></span>
                </div>
                <div class="form-group">
                    <label for="password">Password: <sup>*</sup></label>
                    <input type="password" name="password" class="form-control form-control-lg <?php echo (!empty($data['password_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['password']; ?>">
                    <span class="invalid-feedback"><?php echo $data['password_error']; ?></span>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm Password: <sup>*</sup></label>
                    <input type="password" name="confirm_password" class="form-control form-control-lg <?php echo (!empty($data['confirm_password_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['confirm_password']; ?>">
                    <span class="invalid-feedback"><?php echo $data['confirm_password_error']; ?></span>
                </div>
                <div class="form-group">
                    <label for="avater">Avater: <sup>*</sup></label>
                    <input type="file" name="avater" accept="image/*" class="form-control form-control-lg <?php echo (!empty($data['avater_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['avater']; ?>">
                    <span class="invalid-feedback"><?php echo $data['avater_error']; ?></span>
                </div>
                <div class="form-group">
                    <label for="avater">BIO: <sup>*</sup></label>
                    <textarea name="bio" class="form-control form-control-lg <?php echo (!empty($data['bio_error'])) ? 'is-invalid' : ''; ?>" ><?php echo $data['bio']; ?></textarea>
                    <span class="invalid-feedback"><?php echo $data['bio_error']; ?></span>
                </div>

                <div class="row">
                    <div class="col">
                        <input type="submit" value="Register" class="btn btn-success btn-block">
                    </div>
                    <div class="col">
                        <a href="<?php echo URLROOT; ?>/users/login" class="btn btn-light btn-block">Have an account? Login</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require_once(APPROOT.'/views/includes/footer.php'); ?>