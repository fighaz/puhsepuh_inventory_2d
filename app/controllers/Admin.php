<?php
class Admin extends Controller
{
    public function index()
    {
        // $data['admin'] = $this->model('Peminjaman')->getPeminjamanToApprove();
        $this->view('admin/index');
    }
    public function peminjaman()
    {
        $data['admin'] = $this->model('Peminjaman')->getAllPeminjaman();
        $this->view('admin/index', $data);
    }
    public function approve($id)
    {
        $this->model('Peminjaman')->approvePeminjaman($id);
        header('Location: ' . BASEURL . '/Admin');
    }
    public function tolak($id)
    {
        $this->model('Peminjaman')->tolakePeminjaman($id);
        header('Location: ' . BASEURL . '/Admin');
    }
    public function detailPeminjaman($id)
    {
        $data['detail'] = $this->model('Detail_Peminjaman')->getDetailPeminjaman($id);
        $this->view('admin/peminjaman', $data);
    }
    public function cari()
    {
        $data['barang'] = $this->model('Barang')->cariDataBarang();
        $this->view('barang/index', $data);
    }

}
?>