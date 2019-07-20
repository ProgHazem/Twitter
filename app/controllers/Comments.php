<?php
/**
 * Created by PhpStorm.
 * User: hazem
 * Date: 7/19/19
 * Time: 8:27 PM
 */

class Comments extends Controller
{

    public function __construct()
    {
        if (!loggedin()) {
            flash('Error', 'Please Login First', 'alert alert-danger');
            redirectTo('users/login');
        }
        $this->commentModel = $this->model('Comment');
    }
    //create comment
    public function create($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Filter Array Data from Form
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //validate title
            if (empty($_POST['content'])) {
                flash('Error_comment', 'Please Fill comment field');
                return redirectTo('tweetes/show/'.$id);
            }
            //no errors
            if (! empty($_POST['content'])) {
                $data = [
                  'content' => $_POST['content'],
                  'user_id' => $_SESSION['user_id'],
                  'tweet_id' => $id,
                  'created_at' => date('Y-m-d H:i:s'),
                ];
                if ($this->commentModel->create($data)) {
                    flash('Error_comment', 'Comment Added Successfully');
                    return redirectTo('tweetes/show/' . $id);
                }
            }
        } else {
            return redirectTo('tweetes/show/'.$id);
        }
    }

}