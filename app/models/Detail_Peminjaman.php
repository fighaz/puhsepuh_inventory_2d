<?php

class Detail_Peminjaman {
    private $table = 'detail_peminjaman';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }
    public function tambahDataPeminjaman($data, $id) {
        for($i = 0; $i < count($data['id_barang']); $i++) {
            $query = "INSERT INTO detail_peminjaman
            VALUES
          ('', :id_peminjaman, :id_barang, :jumlah)";

            $this->db->query($query);
            $this->db->bind('id_peminjaman', $id);
            $this->db->bind('id_barang', $data['id_barang'][$i]);
            $this->db->bind('jumlah', $data['jumlah'][$i]);

            $this->db->execute();

            return $this->db->rowCount();
        }

    }
    public function getDetailPeminjaman($id) {
        $query = "SELECT p.id,p.id_user,p.status,p.keterangan,p.tanggal_peminjaman,p.tanggal_pengembalian,dp.id_barang,dp.jumlah
        FROM detail_peminjaman JOIN ON p.id = dp.id_peminjaman WHERE p.id = $id";
        $this->db->query($query);
        $this->db->execute();
    }
}
?>