<?php
session_start();
/*
 * Flash Message Helper
 * Example - flash(register_success', 'You Register Successfully");
 * Display IN View echo flash('register_success');
 */
function flash($name = '', $message = '', $class = 'alert alert-success')
{
    if (!empty($name)) {
        if (!empty($message) && empty($_SESSION[$name])) {
            if (!empty($_SESSION[$name])) {
                unset($_SESSION[$name]);
            }
            if (!empty($_SESSION[$name . '_class'])) {
                unset($_SESSION[$name . '_class']);
            }

            $_SESSION[$name] = $message;
            $_SESSION[$name . '_class'] = $class;
        } elseif (empty($message) && !empty($_SESSION[$name])) {
            $class = !empty($_SESSION[$name . '_class']) ? $_SESSION[$name . '_class'] : '';
            echo "<div id='meg-flash' class='{$class} alert-dismissible fade show' role='alert'>$_SESSION[$name]<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
            unset($_SESSION[$name]);
            unset($_SESSION[$name . '_class']);
        }
    }
}


//check if user login or not
function loggedin()
{
    if (isset($_SESSION['user_id'])) {
        return true;
    }
    return false;
}
