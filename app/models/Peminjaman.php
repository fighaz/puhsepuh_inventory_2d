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
    public function getDetailPeminjaman($id)
    {
        $this->db->query("
            SELECT
                p.id,
                p.id_user,
                u.nama AS nama_user,
                u.username AS username_user,
                p.status,
                p.tanggal_peminjaman,
                p.tanggal_pengembalian,
                p.perubahan_status
            FROM
                peminjaman p
            JOIN users u ON p.id_user = u.id
            WHERE
                p.id = :id

            GROUP BY
                p.id, p.id_user, u.nama, u.username, p.status, p.tanggal_peminjaman, p.tanggal_pengembalian, p.perubahan_status;
        ");
        $this->db->bind('id', $id);
        return $this->db->single();
    }
    public function getDetailBarangById($id)
    {
        $this->db->query("
            SELECT
                dp.id_barang,
                b.nama AS nama_barang,
                b.gambar AS gambar_barang,
                b.tersedia AS barang_tersedia,
                dp.jumlah,
                dp.keterangan
            FROM
                detail_peminjaman dp
            JOIN barang b ON dp.id_barang = b.id
            WHERE
                dp.id_peminjaman = :id; 
        ");
        $this->db->bind('id', $id);
        return $this->db->resultset();
    }
    public function getPeminjamanByUserId($iduser)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id_user=:iduser');
        $this->db->bind('iduser', $iduser);
        return $this->db->resultSet();
    }

    public function tambahDataPeminjaman($data, $iduser)
    {
        $query = "INSERT INTO peminjaman
                    VALUES
                  (NULL, :id_user, :status, :tanggal_peminjaman, :tanggal_pengembalian, NULL);
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
        $query = "UPDATE peminjaman SET status='menunggu_diambil',perubahan_status = CURRENT_TIMESTAMP WHERE id= :id";
        $this->db->query($query);
        $this->db->bind('id', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }
    public function approveAmbilPeminjaman($id)
    {
        $query = "UPDATE peminjaman SET status='dipinjam',perubahan_status = CURRENT_TIMESTAMP WHERE id= :id";
        $this->db->query($query);
        $this->db->bind('id', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }
    public function tolakPeminjaman($id)
    {
        $query = "UPDATE peminjaman SET status='ditolak',perubahan_status = CURRENT_TIMESTAMP WHERE id= :id";
        $this->db->query($query);
        $this->db->bind('id', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }
    public function peminjamanSelesai($id)
    {
        $query = "UPDATE peminjaman SET status='selesai',perubahan_status = CURRENT_TIMESTAMP WHERE id= :id";
        $this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->execute();

        return $this->db->rowCount();
    }
}
?>