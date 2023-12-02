<?php

class Barang
{
    private $table = 'barang';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllBarang()
    {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }

    public function getBarangById($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function tambahDataBarang($data)
    {
        $query = "INSERT INTO barang
                    VALUES
                  ('', :nama, :jumlah, :kondisi, :asal, :keterangan, :maintainer, :gambar)";

        $this->db->query($query);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('jumlah', $data['jumlah']);
        $this->db->bind('kondisi', $data['kondisi']);
        $this->db->bind('asal', $data['asal']);
        $this->db->bind('keterangan', $data['keterangan']);
        $this->db->bind('maintainer', $data['maintainer']);
        $this->db->bind('gambar', $data['gambar']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function hapusDataBarang($id)
    {
        $query = "DELETE FROM barang WHERE id = :id";

        $this->db->query($query);
        $this->db->bind('id', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }


    public function ubahDataBarang($data)
    {
        $query = "UPDATE barang SET
                    nama = :nama, :jumlah, :kondisi, :asal, :keterangan, :maintainer, :gambar
                  WHERE id = :id";

        $this->db->query($query);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('jumlah', $data['jumlah']);
        $this->db->bind('kondisi', $data['kondisi']);
        $this->db->bind('asal', $data['asal']);
        $this->db->bind('keterangan', $data['keterangan']);
        $this->db->bind('maintainer', $data['maintainer']);
        $this->db->bind('gambar', $data['gambar']);
        $this->db->bind('id', $data['id']);

        $this->db->execute();

        return $this->db->rowCount();
    }


    public function cariDataBarang()
    {
        $keyword = $_POST['keyword'];
        $query = "SELECT * FROM barang WHERE nama LIKE :keyword";
        $this->db->query($query);
        $this->db->bind('keyword', "%$keyword%");
        return $this->db->resultSet();
    }

}