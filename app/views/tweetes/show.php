<?php require APPROOT . '/views/includes/header.php'; ?>
<a href="<?php echo URLROOT; ?>" class="btn btn-danger mb-3"><i class="fa fa-backward" aria-hidden="true"></i> Back</a>
<br>
<?php flash('Error_comment'); ?>
<h1><?php echo $data['tweet']->title; ?></h1>
<div class="bg-secondary text-white p-2 mb-3">
    Written by <?php echo $data['user']->fullname; ?> on <?php echo $data['tweet']->created_at; ?>
</div>
<p><?php echo $data['tweet']->content; ?></p>
<hr>
<!--Reply-->
<div class="card mb-3 col-10">
    <div class="card-header font-weight-bold">Leave a reply</div>
    <div class="card-body">
        <!-- Default form reply -->
        <form class="form" action="<?php echo URLROOT . "/comments/create/" . $data['tweet']->id ?>" method="post">
            <!-- Comment -->
            <div class="form-group">
                <label for="replyFormComment">Your comment<sup>*</sup></label>
                <textarea class="form-control form-control-lg " id="replyFormComment" name="content"
                          placeholder="Add a Comment..."></textarea>
            </div>
            <div class="text-center mt-4">
                <button class="btn btn-info btn-block" type="submit">Post</button>
            </div>
        </form>
        <!-- Default form reply -->
    </div>
</div>
<!--/.Reply-->
<hr/>
<!--Comments-->
<div class="card card-comments col-10">
    <div class="card-header font-weight-bold">Comments</div>
    <div class="card-body">
        <?php if ($data['comments'] != 'false') {
            for ($i = 0; $i < count($data['comments']); $i++) { ?>
                <div class="media d-block d-md-flex mt-4">
                    <img class="d-flex mb-3 mx-auto "
                         src="<?php echo URLROOT; ?>/images/users/<?php echo $data['comments'][$i]->avater; ?>"
                         alt="avater">
                    <div class="media-body text-center text-md-left ml-md-3 ml-0">
                        <h5 class="mt-0 font-weight-bold"><?php echo $data['comments'][$i]->fullname ?><a
                                    href="#"
                                    class="pull-right">
                                <i class="fas fa-reply"></i>
                            </a></h5>
                        <?php echo $data['comments'][$i]->content; ?>
                        <?php if ($data['reply_comments'][$i] !== 'false') {
                            for ($j = 0; $j < count($data['reply_comments'][$i]); $j++) { ?>
                                <div class="media d-block d-md-flex mt-3">
                                    <img class="d-flex mb-3 mx-auto "
                                         src="<?php echo URLROOT; ?>/images/users/<?php echo $data['reply_comments'][$i][$j]->avater; ?>"
                                         alt="avater">
                                    <div class="media-body text-center text-md-left ml-md-3 ml-0">
                                        <h5 class="mt-0 font-weight-bold"><?php echo $data['reply_comments'][$i][$j]->fullname; ?>
                                            <a href="#"
                                               class="pull-right">
                                                <i class="fas fa-reply"></i>
                                            </a></h5>
                                        <?php echo $data['reply_comments'][$i][$j]->content; ?>
                                    </div>
                                </div>
                            <?php }
                        } ?>
                        <hr/>
                        <!-- Quick Reply -->
                        <form class="form"
                              action="<?php echo URLROOT . "/replies/create/" . $data['comments'][$i]->id. "/".  $data['tweet']->id?>"
                              method="post">
                            <!-- Comment -->
                            <div class="form-group">
                                <label for="replyFormComment">Your comment<sup>*</sup></label>
                                <textarea class="form-control form-control-lg " id="replyFormComment" name="content"
                                          placeholder="Add a Comment..."></textarea>
                            </div>
                            <div class="text-center mt-4">
                                <button class="btn btn-info btn-block" type="submit">Post</button>
                            </div>
                        </form>
                    </div>
                </div>
                <hr/>
            <?php }
        } ?>
    </div>
</div>
<!--/.Comments-->
<?php require APPROOT . '/views/includes/footer.php'; ?>
