<?php

class Barang_model
{
    private $table = 'barang';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllBarang()
    {
        $this->db->query('SELECT b.id,b.nama,b.jumlah,b.tersedia,b.kondisi,k.nama as asal,b.keterangan,b.maintainer,b.gambar FROM `barang` as b INNER JOIN kategori as k ON b.asal =k.id;');
        return $this->db->resultSet();
    }

    public function getBarangById($id)
    {
        $this->db->query('SELECT b.id as id_barang,b.nama as nama,b.jumlah as jumlah,b.tersedia as tersedia,b.kondisi as kondisi,b.asal as id_asal,k.nama as asal,b.keterangan,b.maintainer,b.gambar FROM `barang` as b INNER JOIN kategori as k ON b.asal =k.id WHERE b.id=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function tambahDataBarang($data, $gambar)
    {
        $query = "INSERT INTO barang
                    VALUES
                  (NULL, :nama, :jumlah, :tersedia, :kondisi, :asal, :keterangan, :maintainer, :gambar)";

        $this->db->query($query);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('jumlah', $data['jumlah']);
        $this->db->bind('tersedia', $data['tersedia']);
        $this->db->bind('kondisi', $data['kondisi']);
        $this->db->bind('asal', $data['asal']);
        $this->db->bind('keterangan', $data['keterangan']);
        $this->db->bind('maintainer', $data['maintainer']);
        $this->db->bind('gambar', $gambar);

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


    public function ubahDataBarang($data, $gambar)
    {
        $query = "UPDATE barang SET
                    nama = :nama,jumlah = :jumlah,tersedia = :tersedia,kondisi = :kondisi,asal = :asal,keterangan = :keterangan,maintainer = :maintainer,gambar= :gambar
                  WHERE id = :id";

        $this->db->query($query);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('jumlah', $data['jumlah']);
        $this->db->bind('tersedia', $data['tersedia']);
        $this->db->bind('kondisi', $data['kondisi']);
        $this->db->bind('asal', $data['asal']);
        $this->db->bind('keterangan', $data['keterangan']);
        $this->db->bind('maintainer', $data['maintainer']);
        $this->db->bind('gambar', $gambar);
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
    public function updateTersedia($id, $jumlah)
    {
        $query = "UPDATE barang SET tersedia = tersedia + :jumlah
      WHERE id = :id";

        $this->db->query($query);

        $this->db->bind('jumlah', $jumlah);
        $this->db->bind('id', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }

}
