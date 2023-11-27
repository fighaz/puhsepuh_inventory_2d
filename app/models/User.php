<?php
class User
{
    private $table = 'user';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
    public function getUserByUsername($username)
    {
        $query = "SELECT * FROM user WHERE username=:username";
        $this->db->query($query);
        $this->db->bind('username', $username);
        $this->db->execute();
    }
}
?>