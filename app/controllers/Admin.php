<?php
class Admin extends Controller
{
    public $sidebar;
    public function __construct()
    {
        parent::__construct();
        session_start();
        $this->sidebar = $this->sidebar_admin;
    }
    public function index()
    {
        $data['pnj'] = $this->model('Peminjaman')->getPeminjamanToApprove();
        $this->active_sidebar = "home";
        $this->view('admin/index', $data);
    }
    public function inventaris()
    {
        //$data['barang'] = $this->model('Barang')->getAllBarang();
        $this->active_sidebar = "inventaris";
        $this->view('admin/list_inventory');
    }
    public function peminjaman()
    {
        //$data['admin'] = $this->model('Peminjaman')->getAllPeminjaman();
        $this->active_sidebar = "peminjaman";
        $this->view('admin/riwayat_peminjaman');
    }
    public function peminjam()
    {
        $this->active_sidebar = "peminjam";
        $this->view('admin/peminjam');
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
    public function tambahInventaris()
    {
        $data['sidebar'] = $this->sidebar;
        $this->view('admin/tambahinventaris', $data);
    }
    public function ubahInventaris()
    {
        $data['sidebar'] = $this->sidebar;
        $this->view('admin/ubahinventaris', $data);
    }
}
?>
