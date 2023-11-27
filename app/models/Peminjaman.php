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

    public function tambahDataPeminjaman($data)
    {
        $query = "INSERT INTO peminjaman
                    VALUES
                  ('', :id_admin, :id_user, :status, :tanggal_peminjaman, :tanggal_pengembalian)";

        $this->db->query($query);
        $this->db->bind('id_admin', $data['id_admin']);
        $this->db->bind('id_user', $data['id_user']);
        $this->db->bind('status', "menunggu");
        $this->db->bind('tangggal_peminjaman', $data['tangggal_peminjaman']);
        $this->db->bind('tanggal_pengembalian', $data['tanggal_pengembalian']);


        $this->db->execute();

        return $this->db->rowCount();
    }

    public function hapusDataPeminjaman($id)
    {
        $query = "DELETE FROM peminjaman WHERE id = :id";

        $this->db->query($query);
        $this->db->bind('id', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }
}
?>