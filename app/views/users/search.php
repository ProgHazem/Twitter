<?php require_once(APPROOT . '/views/includes/header.php');
flash('Follow');
?>
<?php if ($data != 'false') {
    foreach ($data as $da) { ?>
        <div class="card card-body mb-3">
            <h4 class="card-title"><?php echo $data['tweetes'][$i]->title; ?></h4>
            <div class="bg-light p-2 mb-3">
                <div class="row">
                    <div class="col-4">
                        <img
                                src="<?php echo URLROOT; ?>/images/users/<?php echo $da->avater; ?>" alt="..."
                                width="130" class="rounded mb-2 img-thumbnail">
                    </div>
                    <div class="col-8">
                        <p class="small mb-2"><i class="fa fa-user-o fa-lg"></i> <?php echo $da->fullname; ?></p>
                        <p class="small mb-2"><i class="fa fa-envelope-o fa-lg"></i> <?php echo $da->email; ?></p>
                        <a class="btn btn-dark" href="<?php echo URLROOT; ?>/users/profile/<?php echo $da->id; ?>">Show
                            More</a>
                    </div>
                </div>
            </div>
        </div>
    <?php }
} else { ?>
    <div class="card card-body mb-3">
        <h4 class="card-title">Not Found</h4>
        <div class="bg-light p-2 mb-3">
            <div class="row">
                <div class="col-12">
                    <h1 class="text-center">Not Found users Try Again</h1>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<?php require_once(APPROOT . '/views/includes/footer.php'); ?>
