<?php
/**
 * Created by PhpStorm.
 * User: hazem
 * Date: 7/18/19
 * Time: 7:41 PM
 */

class Tweetes extends Controller
{
    public function __construct()
    {
        if (!loggedin()) {
            flash('Error', 'Please Login First', 'alert alert-danger');
            redirectTo('users/login');
        }
        $this->tweetModel = $this->model('Tweet');
        $this->commentModel = $this->model('Comment');
        $this->userModel = $this->model('User');
        $this->replyModel = $this->model('Reply');
    }

    public function index()
    {
        $allTweetes = $this->tweetModel->all_tweetes_by_date();
        $number_comment = [];
        if ($allTweetes != 'false') {
            foreach ($allTweetes as $tweet) {
                $number = $this->commentModel->count_comment_for_tweet($tweet->id);
                array_push($number_comment, $number);
            }
        }

        $data = [
            'tweetes' => $allTweetes,
            'comments_number' => $number_comment,
        ];
//        echo "<pre>";
//        print_r($allTweetes);
//        echo "</pre?";
//        die("fff");
        return $this->view('tweetes/index', $data);

    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Filter Array Data from Form
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'title' => trim($_POST['title']),
                'content' => trim($_POST['content']),
                'user_id' => $_SESSION['user_id'],
                'created_at' => date('Y-m-d H:i:s'),
                'title_error' => '',
                'content_error' => '',
            ];

            //validate title
            if (empty($data['title'])) {
                $data['title_error'] = 'Please Enter Title';
            }

            //validate content
            if (empty($data['content'])) {
                $data['content_error'] = 'Please Enter Content';
            }

            //no errors
            if (empty($data['title_error']) && empty($data['content_error'])) {
                if ($this->tweetModel->add_tweet($data)) {
                    flash('tweet_add', 'Tweet Added Successfully');
                    return redirectTo('tweetes/index');
                }else{

                }
            } else {
                return $this->view('tweetes/create', $data);
            }


        } else {
            $data = [
                'title' => '',
                'content' => '',
            ];
            return $this->view('tweetes/create', $data);
        }
    }

    //function to show only tweet

    /**
     * @return mixed
     */
    public function show($id)
    {
        $tweet =  $this->tweetModel->getTweet($id);
        $user = $this->userModel->get_user_by_id($tweet->user_id);
        $comments = $this->commentModel->get_all_comments($tweet->id);

        $replyComments  = [];
        if ($comments !== 'false') {
            foreach ($comments as $comment) {
                $reply_comment = $this->replyModel->get_reply_comments($comment->id);
                array_push($replyComments, $reply_comment);
            }
        }
        $data = [
            'tweet' => $tweet,
            'user' => $user,
            'comments' => $comments,
            'reply_comments' => $replyComments,
        ];
        return $this->view('tweetes/show', $data);
    }

    //type to show
    public function typeshow()
    {
        $type = $_POST['type'];
        if ($type == 'date') {
            $this->index();
        } elseif($type == 'comment') {
            $allTweetes = $this->tweetModel->all_tweetes_by_comments();
            $number_comment = [];
            if ($allTweetes != 'false') {
                foreach ($allTweetes as $tweet) {
                    array_push($number_comment, $tweet->count_comments);
                }
            }
            $data = [
                'tweetes' => $allTweetes,
                'comments_number' => $number_comment,
            ];
            return $this->view('tweetes/index', $data);

        } else {
            $this->index();
        }
    }
}