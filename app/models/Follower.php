<?php
/**
 * Created by PhpStorm.
 * User: hazem
 * Date: 7/20/19
 * Time: 4:42 AM
 */

class Follower
{
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    //All Tweets
    public function get_follower($id)
    {
        $this->db->query("SELECT * FROM followers where follower_id = :id");
        $this->db->bind(':id', $id);
        $rows = $this->db->single();
        //number of result
        if ($this->db->rowCount() > 0 ) {
            return true;
        } else {
            return false;
        }
    }
    //add follower
    public function add_follower($data)
    {
        $this->db->query("INSERT INTO followers (user_id, follower_id) values (:user_id, :follower_id)");
        //bind
        $this->db->bind(':user_id', $_SESSION['user_id']);
        $this->db->bind(':follower_id', $data['follower_id']);
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}