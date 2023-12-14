<?php
class Peminjaman
{
    private $table = 'peminjaman';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
    public function getAllPeminjaman()
    {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }
    public function getPeminjamanToApprove()
    {
        $this->db->query("SELECT * FROM all_peminjaman WHERE status = :status");
        $status = "menunggu_konfirmasi";
        $this->db->bind('status', $status);
        return $this->db->resultSet();
    }

    public function getPeminjamanById($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }
    public function getPeminjamanByUserId($iduser)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id_user=:iduser');
        $this->db->bind('iduser', $iduser);
        return $this->db->single();
    }

    public function tambahDataPeminjaman($data, $iduser)
    {
        $query = "INSERT INTO peminjaman
                    VALUES
                  (NULL, :id_user, :status, :tanggal_peminjaman, :tanggal_pengembalian);
                     SELECT LAST_INSERT_ID() as last_insert_id;";

        $status = "menunggu_konfirmasi";
        $this->db->query($query);
        $this->db->bind('id_user', $iduser);
        $this->db->bind('status', $status);
        $this->db->bind('tanggal_peminjaman', $data['tanggal_peminjaman']);
        $this->db->bind('tanggal_pengembalian', $data['tanggal_pengembalian']);
        $this->db->execute();

        return $this->db->last_insert_id();


    }

    public function approvePeminjaman($id)
    {
        $query = "UPDATE peminjaman SET status='dipinjam' WHERE id= :id";
        $this->db->query($query);
        $this->db->bind('id', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }
    public function tolakPeminjaman($id)
    {
        $query = "UPDATE peminjaman SET status='ditolak' WHERE id= :id";
        $this->db->query($query);
        $this->db->bind('id', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }
}
?>