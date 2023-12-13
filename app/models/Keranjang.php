<?php
class Keranjang
{
    private $table = 'keranjang';
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }
    public function getAllKeranjangByUserId()
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id_user = :id_user');
        $this->db->bind('id_user', $_SESSION['id_user']);
        return $this->db->resultSet();
    }
    public function tambahItemKeranjang($iduser, $idbarang)
    {
        $query = "INSERT INTO keranjang
                    VALUES
                  ( :id_user, :id_barang)";

        $this->db->query($query);
        $this->db->bind('id_user', $_SESSION['id_user']);
        $this->db->bind('id_barang', $idbarang);

        $this->db->execute();

        return $this->db->rowCount();
    }
    public function hapusItemKeranjangByUserId($iduser, $idbarang)
    {
        $query = "DELETE FROM kategori WHERE id_user = :id_user AND id_barang = :id_barang";

        $this->db->query($query);
        $this->db->bind('id_user', $iduser);
        $this->db->bind('id_barang', $idbarang);

        $this->db->execute();

        return $this->db->rowCount();
    }
    public function hapusDataKeranjangByUserId($id)
    {
        $query = "DELETE FROM keranjang WHERE id_user = :id_user";

        $this->db->query($query);
        $this->db->bind('id_user', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }




}
?>
