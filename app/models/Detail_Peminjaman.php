<?php

class Detail_Peminjaman
{
    private $table = 'detail_peminjaman';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
    public function tambahDataPeminjaman($data, $id)
    {
        for ($i = 0; $i < count($data); $i++) {
            $query = "INSERT INTO detail_peminjaman
            VALUES
          (:id_peminjaman, :id_barang, :jumlah, :keterangan)";

            $this->db->query($query);
            $this->db->bind('id_peminjaman', $id);
            $this->db->bind('id_barang', $data[$i]['id_barang']);
            $this->db->bind('jumlah', $data[$i]['jumlah']);
            $this->db->bind('keterangan', $data[$i]['catatan']);

            $this->db->execute();


        }

        return $this->db->rowCount();
    }
    public function getDetailPeminjaman($id)
    {
        $query = " SELECT p.id, p.id_user, p.status, p.tanggal_peminjaman, p.tanggal_pengembalian, dp.id_barang, dp.jumlah, dp.keterangan
            FROM peminjaman p
            JOIN detail_peminjaman dp
            ON p.id = dp.id_peminjaman
            WHERE p.id = :id";
        $this->db->query($query);
        $this->db->bind('id', $id);
        return $this->db->resultSet();
    }
    public function updateDetailPeminjaman($data, $id)
    {
        for ($i = 0; $i < count($data); $i++) {
            $query = "UPDATE detail_peminjaman
            SET jumlah = :jumlah,keterangan = :keterangan WHERE id_peminjaman = :id_peminjaman AND id_barang = :id_barang";

            $this->db->query($query);
            $this->db->bind('id_peminjaman', $id);
            $this->db->bind('id_barang', $data[$i]['id_barang']);
            $this->db->bind('jumlah', $data[$i]['jumlah']);
            $this->db->bind('keterangan', $data[$i]['catatan']);

            $this->db->execute();


        }

        return $this->db->rowCount();
    }
}
?>
