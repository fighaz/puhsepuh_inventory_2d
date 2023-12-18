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
    public function changePassword($password, $id)
    {
        $password = password_hash($password, PASSWORD_BCRYPT);
        $isChangePassword = 1;
        $query = "UPDATE users SET password = :password,isChangePassword = :isChangePassword WHERE id= :id";
        $this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->bind('password', $password);
        $this->db->bind('isChangePassword', $isChangePassword);
        $this->db->execute();
        return $this->db->rowCount();
    }
    public function getAllPeminjam()
    {
        $role = "User";
        $query = "SELECT * FROM users WHERE role = :role";
        $this->db->query($query);
        $this->db->bind('role', $role);
        return $this->db->resultSet();
    }

    public function getPeminjamById($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function tambahDataPeminjam($data)
    {
        $query = "INSERT INTO users
                    VALUES
                  (NULL, :username, :password, :nama, :notelp, :email, :role, :isChangePassword)";

        $password = password_hash($data['username'], PASSWORD_BCRYPT);
        $role = "User";
        $isChangePassword = 0;
        $this->db->query($query);
        $this->db->bind('username', $data['username']);
        $this->db->bind('password', $password);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('notelp', $data['notelp']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('role', $role);
        $this->db->bind('isChangePassword', $isChangePassword);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function hapusDataPeminjam($id)
    {
        $query = "DELETE FROM users WHERE id = :id";

        $this->db->query($query);
        $this->db->bind('id', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }


    public function ubahDataPeminjam($data)
    {
        $query = "UPDATE users SET
                    username = :username,password = :password,nama = :nama ,notelp = :notelp,email = :email WHERE id = :id";


        $this->db->query($query);
        $password = password_hash($data['username'], PASSWORD_BCRYPT);
        $this->db->bind('username', $data['username']);
        $this->db->bind('password', $password);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('notelp', $data['notelp']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('id', $data['id']);
        $this->db->execute();

        return $this->db->rowCount();
    }
    public function resetPassword($id)
    {
        $query = "UPDATE users SET
        password = :password WHERE id = :id";

        $password = password_hash("password", PASSWORD_BCRYPT);
        $this->db->query($query);
        $this->db->bind('password', $password);
        $this->db->bind('id', $id);
        $this->db->execute();

        return $this->db->rowCount();

    }
    public function cariDataPeminjam()
    {
        $keyword = $_POST['keyword'];
        $query = "SELECT * FROM users WHERE nama LIKE :keyword";
        $this->db->query($query);
        $this->db->bind('keyword', "%$keyword%");
        return $this->db->resultSet();
    }
}
?>