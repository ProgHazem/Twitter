<?php
class Comment {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // get number for tweet
    public function count_comment_for_tweet($id) {
        $this->db->query("SELECT count(*) as number_of_comment FROM comments WHERE tweet_id = :id ");
        $this->db->bind(':id', $id);
        $count_row = $this->db->single();
        return $count_row->number_of_comment;
    }
    // get comments for tweet
    public function get_all_comments($id) {
        $this->db->query("SELECT *, comments.id FROM comments, users WHERE tweet_id = :id and comments.user_id = users.id");
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
        $this->db->query("SET FOREIGN_KEY_CHECKS=0;");
        $this->db->query("INSERT INTO comments (content, user_id, tweet_id, created_at) values (:content, :user_id,  :tweet_id, :created_at)");
        //bind
        $this->db->bind(':content', $data['content']);
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':tweet_id', $data['tweet_id']);
        $this->db->bind(':created_at', $data['created_at']);
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}