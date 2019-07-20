<?php
/**
 * Created by PhpStorm.
 * User: hazem
 * Date: 7/18/19
 * Time: 7:55 PM
 */

require_once(APPROOT . '/views/includes/header.php');
flash('tweet_add');
?>
<div class="row mb-3">
    <div class="col-md-3">
        <h1>Tweetes</h1>
    </div>

    <div class="col-md-4">
        <a class="btn btn-primary pull-right" href="<?php echo URLROOT; ?>/tweetes/create"><i class="fa fa-pencil" aria-hidden="true"></i> Add Tweet</a>
    </div>
    <div class="col-md-4">
        <form class="form-inline" action="<?php echo URLROOT; ?>/tweetes/typeshow" method="post">
            <div class="form-group">
                <select class="form-control" name="type">
                    <option value="date">Show According To Date</option>
                    <option value="comment">Show According To Comment</option>
                </select>
            </div>
            <div>
                <input type="submit" class="btn btn-dark" value="submit" >
            </div>
        </form>
    </div>
</div>
<?php if ($data['tweetes'] == 'false') { ?>
    <div class="card card-body mb-3">
        <h4 class="card-title"><?php echo "Not Found Tweetes"; ?></h4>
        <p class="card-text"><?php echo "No Tweeted To show"; ?></p>
    </div>
<?php } else {
    for($i = 0; $i < count($data['tweetes']);$i++){
        ?>
            <div class="card card-body mb-3">
                <h4 class="card-title"><?php echo $data['tweetes'][$i]->title; ?></h4>
                <div class="bg-light p-2 mb-3">
                    Written by <i class="fa fa-user-o"></i> <?php echo $data['tweetes'][$i]->fullname; ?> on <i class="fa fa-clock-o"></i> <?php echo $data['tweetes'][$i]->created_at; ?>
                </div>
                <p class="card-text"><?php echo sub_words($data['tweetes'][$i]->content); ?></p>
                <div class="bg-light p-2 mb-3">
                    Comments <i class="fa fa-comment-o"></i> <?php echo $data['comments_number'][$i]; ?>
                </div>
                <a class="btn btn-dark" href="<?php echo URLROOT; ?>/tweetes/show/<?php echo $data['tweetes'][$i]->id; ?>">Show More</a>
            </div>
    <?php }
}
require_once(APPROOT . '/views/includes/footer.php');
?>