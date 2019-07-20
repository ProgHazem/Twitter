<nav class="navbar navbar-expand-lg  navbar-dark bg-dark mb-1">
    <div class="container">
        <a class="navbar-brand" href="<?php echo URLROOT;?>"><img src="<?php echo URLROOT; ?>/images/logo.png" width="25" height="25" /> <?php echo SITENAME; ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#twitter" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="twitter">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo URLROOT;?>">Home</a>
                </li>
            </ul>
            <?php if ( loggedin()) { ?>
            <form class="form-inline my-lg-0" action="<?php echo URLROOT . '/users/search';?>" method="post">
                <input class="form-control mr-sm-2" name="namesearch" type="search" placeholder="Search name" aria-label="Search">
                <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
            </form>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URLROOT; ?>/users/profile/<?php echo $_SESSION['user_id'];?>"><?php echo $_SESSION['fullname'] ?> Profile  <i class="fa fa-user-o"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URLROOT; ?>/users/logout">Logout <i class="fa fa-sign-out"></i></a>
                </li>
            </ul>
            <?php } else { ?>
                <ul class="navbar-nav ml-auto">

                <li class="nav-item">
                        <a class="nav-link" href="<?php echo URLROOT; ?>/users/register">Register <i class="fa fa-registered"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo URLROOT; ?>/users/login">Login <i class="fa fa-sign-in"></i></a>
                    </li>
            </ul>
            <?php }  ?>
        </div>
    </div>
</nav>