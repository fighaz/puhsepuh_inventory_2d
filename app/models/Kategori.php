<?php
class Kategori {
    private $table = 'kategori';
    private $db;
    public function __construct() {
        $this->db = new Database;
    }
    public function getAllKategori() {
        $query = "SELECT * FROM kategori";
        $this->db->query($query);
        return $this->db->resultSet();
    }
    public function tambahDataKategori($data) {
        $query = "INSERT INTO kategori
                    VALUES
                  (NULL, :nama, :keterangan)";

        $this->db->query($query);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('keterangan', $data['keterangan']);

        $this->db->execute();

        return $this->db->rowCount();
    }
    public function hapusDataKategori($id) {
        $query = "DELETE FROM kategori WHERE id = :id";

        $this->db->query($query);
        $this->db->bind('id', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }




}
?>
