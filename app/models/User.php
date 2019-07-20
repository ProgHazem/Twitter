<?php
class User {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function findUserByEmail($email)
    {
        $this->db->query("SELECT * FROM users WHERE email = :email");
        $this->db->bind(':email', $email);
        $row = $this->db->single();
        //number of result
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    //register fun
    public function register($data) {
        $this->db->query("INSERT INTO users (fullname, email, password, avater, bio) values (:fullname, :email, :password, :avater, :bio)");
        //bind
        $this->db->bind(':fullname', $data['fullname']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':avater', $data['avater']);
        $this->db->bind(':bio', $data['bio']);
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    //login fun
    public function login($email, $password) {
        $this->db->query("SELECT * FROM users WHERE email = :email");
        $this->db->bind(':email', $email);
        $row = $this->db->single();
        //hashed password
        $hashed_password = $row->password;
        if(password_verify($password, $hashed_password)) {
            return $row;
        } else {
            return false;
        }
    }


    //Profile fun
    public function profile($id) {
        $this->db->query("SELECT * FROM users WHERE id = :id");
        $this->db->bind(':id', $id);
        $row = $this->db->single();
        if($this->db->rowCount() > 0) {
            return $row;
        } else {
            return 'false';
        }
    }

    //get user by id
    //Profile fun
    public function get_user_by_id($id) {
        $this->db->query("SELECT fullname FROM users WHERE id = :id");
        $this->db->bind(':id', $id);
        $row = $this->db->single();
        if($this->db->rowCount() > 0) {
            return $row;
        } else {
            return 'false';
        }
    }


    //search fun
    public function search($data) {
        $this->db->query("SELECT * FROM users WHERE fullname LIKE '%{$data['namesearch']}%'");
        $rows = $this->db->resultSet();
        if($this->db->rowCount() > 0) {
            return $rows;
        } else {
            return 'false';
        }
    }

}