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

        $gambar = $this->upload();

        if (!$gambar) {
            return false;
        }
        $this->db->query($query);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('jumlah', $data['jumlah']);
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


    public function ubahDataBarang($data)
    {
        $query = "UPDATE barang SET
                    nama = :nama,jumlah = :jumlah,kondisi = :kondisi,asal = :asal,keterangan = :keterangan,maintainer = :maintainer,gambar :gambar
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
    function upload()
    {

        $namaFile = $_FILES['gambar']['name'];
        $ukuranFile = $_FILES['gambar']['size'];
        $error = $_FILES['gambar']['error'];
        $tmpName = $_FILES['gambar']['tmp_name'];
        //cek apakah tidak ada gambar yang diupload
        if ($error === 4) {
            echo "<script> alert('pilih gambar terlebih dahulu!')</script>";
            return false;
        }

        //cek apakah yang diupload adalah gambar
        $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
        $ekstensiGambar = explode('.', $namaFile);
        $ekstensiGambar = strtolower(end($ekstensiGambar));
        if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
            echo "<script> alert('yang anda upload bukan gambar')</script>";
            return false;
        }

        //cek jika ukurannya terlalu besar
        if ($ukuranFile > 10000000) {
            echo "<script> alert('Ukuran gambar terlalu besar!')</script>";
            return false;
        }
        //generate nama gambar baru
        $namaFileBaru = uniqid();
        $namaFileBaru .= '.';
        $namaFileBaru .= $ekstensiGambar;

        //gambar siap diupload
        move_uploaded_file($tmpName, BASEURL . '/img/' . $namaFileBaru);
        return $namaFileBaru;
    }

}