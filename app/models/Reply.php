<?php
class Reply {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }
    // get replay comments for tweet
    public function get_reply_comments($id) {
        $this->db->query("SELECT * FROM replies, users WHERE comment_id = :id and replies.user_id = users.id");
        $this->db->bind(':id', $id);
        $row = $this->db->resultSet();
        if ( $this->db->rowCount()  > 0) {
            return $row;
        } else {
            return 'false';
        }
    }

    // create comment
    public function create($data) {
        $this->db->query("INSERT INTO replies (content, user_id, comment_id, created_at) values (:content, :user_id,  :comment_id, :created_at)");
        //bind
        $this->db->bind(':content', $data['content']);
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':comment_id', $data['comment_id']);
        $this->db->bind(':created_at', $data['created_at']);
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}