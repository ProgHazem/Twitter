<?php
/**
 * Created by PhpStorm.
 * User: hazem
 * Date: 7/16/19
 * Time: 2:32 AM
 */

class Users extends Controller
{
    public function __construct() {
        $this->userModel = $this->model('User');
        $this->followerModel = $this->model('Follower');
    }

    public function login() {
        //check for Post Method
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Post filter
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            //Init data
            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_error' => '',
                'password_error' => ''
            ];
            //validate Email
            if (empty($data['email'])){
                $data['email_error'] = 'Please Enter Email';
            }elseif ( ! filter_var($data['email'], FILTER_SANITIZE_EMAIL)){
                $data['email_error'] = 'Please Enter Valid Email';
            } elseif (! $this->userModel->findUserByEmail($data['email'])) {
                $data['email_error'] = 'This Email Not exsists';
            }

            //validate password
            if (empty($data['password'])){
                $data['password_error'] = 'Please Enter password';
            } elseif (strlen($data['password']) < 8) {
                $data['password_error'] = 'Please Enter password grater than or equal 8';
            }

            if (empty($data['fullname_error']) && empty($data['email_error']) && empty($data['password_error']) && empty($data['confirm_password_error']) && empty($data['avater_error']) && empty($data['bio_error'])) {
                //login
                $logging_user = $this->userModel->login($data['email'], $data['password']);

                //correct
                if ($logging_user) {
                    //create session
                    $this->createUserSession($logging_user);
                } else {
                    //invalid
                    $data['password_error'] = 'Error In Password';
                    return $this->view('users/login', $data);
                }
            } else {
                return $this->view('users/login', $data);
            }

        }else{
            //Init data
            $data = [
                'email' => '',
                'password' => '',
                'email_error' => '',
                'password_error' => '',
            ];
            //load register form
            return $this->view('users/login');
        }
    }

    public function register() {
        //check for Post Method
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Post filter
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            //Init data
            $data = [
                'fullname' => trim($_POST['fullname']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'avater' => '',
                'bio' => trim($_POST['bio']),
                'fullname_error' => '',
                'email_error' => '',
                'password_error' => '',
                'confirm_password_error' => '',
                'avater_error' => '',
                'bio_error' => '',
            ];
            if (!empty($_FILES)) {
                $file_name = $_FILES['avater']['name'];
                $file_size = $_FILES['avater']['size'];
                $file_tmp = $_FILES['avater']['tmp_name'];
                $file_type = $_FILES['avater']['type'];
                $file_ext = explode("/", $_FILES["avater"]["type"]);
                $file_ext = strtolower((end($file_ext)));
                $extensions = array("jpeg", "jpg", "png");
                if (in_array($file_ext, $extensions)) {
                    if (move_uploaded_file($file_tmp, PPUBLICROOT . "/public/images/users/" . $file_name)) {
                        $data['avater'] = $file_name;
                    } else {
                        $data['avater_error'] = "Error in move image";
                    }
                } else {
                    $data['avater_error'] = "The file not image";
                }
            } else {
                $data['avater_error'] = "Please Enter Avater";
            }

            //validate Email
            if (empty($data['email'])){
                $data['email_error'] = 'Please Enter Email';
            }elseif ( ! filter_var($data['email'], FILTER_SANITIZE_EMAIL)){
                $data['email_error'] = 'Please Enter Valid Email';
            } elseif ($this->userModel->findUserByEmail($data['email']))
            {
                $data['email_error'] = 'This Email exsists';
            }

            //validate name
            if (empty($data['fullname'])){
                $data['fullname_error'] = 'Please Enter Name';
            }

            //validate password
            if (empty($data['password'])){
                $data['password_error'] = 'Please Enter password';
            } elseif (strlen($data['password']) < 8) {
                $data['password_error'] = 'Please Enter password grater than or equal 8';
            }

            //validate confirm_password
            if (empty($data['confirm_password'])){
                $data['confirm_password_error'] = 'Please Enter confirm password';
            } else {
                if ($data['password'] != $data['confirm_password']) {
                    $data['confirm_password_error'] = 'password not match';
                }
            }
            //validate bio
            if (empty($data['bio'])){
                $data['bio_error'] = 'Please Enter Bio';
            }
            if (empty($data['fullname_error']) && empty($data['email_error']) && empty($data['password_error']) && empty($data['confirm_password_error']) && empty($data['avater_error']) && empty($data['bio_error'])) {
                //Hash Password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                //Register User
                if ($this->userModel->register($data)) {
                    flash('register_success', 'You Register Successfully and log in now');
                    redirectTo('users/login');
                } else {
                    die("Something Error");
                }
            } else {
                return $this->view('users/register', $data);
            }
        }else{
            //Init data
            $data = [
                'fullname' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'avater' => '',
                'bio' => '',
                'fullname_error' => '',
                'email_error' => '',
                'password_error' => '',
                'confirm_password_error' => '',
                'avater_error' => '',
                'bio_error' => '',
            ];
            //load register form
            return $this->view('users/register');
        }
    }


    public function createUserSession($userData) {
        $_SESSION['user_id'] = $userData->id;
        $_SESSION['fullname'] = $userData->fullname;
        $_SESSION['email'] = $userData->password;
        redirectTo('tweetes/index');
    }

    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['fullname']);
        unset($_SESSION['email']);
        session_destroy();
        redirectTo('users/login/index');
    }

    // User profile
    public function profile($id)
    {
        if (loggedin()) {
            $userData = $this->userModel->profile($id);
            $checkfollow = $this->followerModel->get_follower($id);
            $data = [
                'userdata' => $userData,
                'checkfollow' => $checkfollow,
            ];
            return $this->view('users/profile', $data);
        } elseif (! loggedin() && ! isset($_SESSION['user_id'])) {
            flash('Error', 'Please Login First', 'alert alert-danger');
            redirectTo('users/login');
        }
    }

    // User profile
    public function follow($id)
    {
        $data = [
            'user_id' => $_SESSION['id'],
            'follower_id' => $id,
        ];
        if ($this->followerModel->add_follower($data)) {
            $userData = $this->userModel->profile($id);
            flash('Follow', 'You Follow Your Friend');
            return redirectTo('users/profile/'.$id);
        }
    }

    // User profile
    public function search()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Post filter
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            //Init data
            $data = [
                'namesearch' => trim(ucfirst($_POST['namesearch'])),
            ];
            $result = $this->userModel->search($data);
            return $this->view('users/search', $result);
        }
    }

}