<?php
/**
 * Created by PhpStorm.
 * User: hazem
 * Date: 7/17/19
 * Time: 5:19 AM
 */

    function redirectTo($page) {
        header("Location: ". URLROOT . "/" . $page);
    }


    ?>