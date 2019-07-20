<?php require_once(APPROOT.'/views/includes/header.php'); ?>
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4 text-center"><?php echo $data['title'] ?> <img src="<?php echo URLROOT; ?>/images/logo.png" width="72" height="72" /></h1>
            <hr />
            <p class="lead"><?php echo $data['description'] ?></p>
            <hr />
            <p class="lead">Login Or Register in our social App to communicate with your friends</p>
        </div>
    </div>
<?php require_once(APPROOT.'/views/includes/footer.php'); ?>