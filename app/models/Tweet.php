<?php
class Tweet {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    //All Tweets
    public function all_tweetes_by_date()
    {
        $this->db->query("SELECT *,tweetes.id FROM tweetes, users where tweetes.user_id = users.id ORDER BY created_at desc");
        $rows = $this->db->resultSet();
        //number of result
        if (count($rows) > 0 ) {
            return $rows;
        } else {
            return 'false';
        }
    }
    //All Tweets
    public function add_tweet($data)
    {
        $this->db->query("INSERT INTO tweetes (title, content, user_id, created_at) values (:title, :content, :user_id, :created_at)");
        //bind
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':content', $data['content']);
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':created_at', $data['created_at']);
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    //show Tweet
    public function getTweet($id)
    {
        $this->db->query("SELECT * FROM tweetes where id = :id");
        //bind
        $this->db->bind(':id', $id);
        $rows = $this->db->single();
        //number of result
        if ( $this->db->rowCount()  > 0) {
            return $rows;
        } else {
            return 'false';
        }
    }
    //All Tweets by comments
    public function all_tweetes_by_comments()
    {
        $this->db->query("SELECT tweetes.*, users.*, COUNT(DISTINCT comments.id) AS count_comments, tweetes.id,comments.tweet_id,users.id FROM users, comments, tweetes WHERE users.id = tweetes.user_id AND tweetes.id = comments.tweet_id GROUP BY tweetes.id ORDER BY count_comments DESC");
        $rows = $this->db->resultSet();
        //number of result
        if (count($rows) > 0 ) {
            return $rows;
        } else {
            return 'false';
        }
    }
}