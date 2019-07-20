<?php require_once(APPROOT.'/views/includes/header.php');
flash('Follow');
?>
<div class="row">
    <div class="col-12">
        <!-- Profile widget -->
        <div class="bg-white shadow rounded overflow-hidden">
            <div class="px-4 pt-0 pb-4 bg-dark">
                <div class="media align-items-end profile-header">
                    <div class="profile mr-3"><img src="<?php echo URLROOT; ?>/images/users/<?php echo $data['userdata']->avater; ?>" alt="..." width="130" class="rounded mb-2 img-thumbnail"><a href="" class="btn btn-dark btn-sm btn-block">Edit profile</a></div>
                    <div class="media-body mb-5 text-white">
                        <div class="row">
                            <div class="col-6">
                                <p class="small mb-2"><i class="fa fa-user-o fa-lg"></i> <?php echo $data['userdata']->fullname; ?></p>
                                <p class="small mb-2"><i class="fa fa-envelope-o fa-lg"></i> <?php echo $data['userdata']->email; ?></p>
                                <p class="small mb-2"> <i class="fa fa-map-marker mr-2"></i>San Farcisco</p>
                            </div>
                            <div class="col-6 .overflow-auto">
                                <p class="small mb-2"><i class="fa fa-bookmark-o fa-lg"></i> <?php echo $data['userdata']->bio; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-light p-4 d-flex justify-content-end text-center">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item">
                        <?php if($_SESSION['user_id'] != $data['userdata']->id  && $data['checkfollow'] == false) { ?>
                            <form action="<?php echo URLROOT; ?>/users/follow/<?php echo $data['userdata']->id ?>" method="post">
                                <div class="form-group">
                                    <input type="submit" class="btn btn-outline-primary" value="Follow" />
                                </div>
                            </form>
                        <?php } elseif($_SESSION['user_id'] != $data['userdata']->id ) { ?>
                            <div class="form-group">
                                <input type="submit" class="btn btn-outline-success" value="following" />
                            </div>
                        <?php } ?>
                    </li>
                    <li class="list-inline-item">
                        <h5 class="font-weight-bold mb-0 d-block">241</h5><small class="text-muted"> <i class="fa fa-picture-o mr-1"></i>Photos</small>
                    </li>
                    <li class="list-inline-item">
                        <h5 class="font-weight-bold mb-0 d-block">84K</h5><small class="text-muted"> <i class="fa fa-user-circle-o mr-1"></i>Followers</small>
                    </li>
                </ul>
            </div>
        </div><!-- End profile widget -->
    </div>
</div>
<?php require_once(APPROOT.'/views/includes/footer.php'); ?>
