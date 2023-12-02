<?php
class User
{
    private $table = 'users';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
    public function getUserByUsername($username)
    {
        $query = "SELECT * FROM users WHERE username= :username";
        $this->db->query($query);
        $this->db->bind('username', $username);
        $this->db->execute();
        return $this->db->single();
    }
    public function changePassword($password)
    {
        $id = $_SESSION['iduser'];
        $query = "UPDATE user SET password = :password WHERE id= :id";
        $this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->bind('password', $password);
        $this->db->execute();


    }
}
?>