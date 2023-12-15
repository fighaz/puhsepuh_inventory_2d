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
        $data['brg'] = $this->model('Barang_model')->getAllBarang();
        $this->active_sidebar = "inventaris";
        $this->view('admin/list_inventory', $data);
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
    public function approveAmbil($id)
    {
        $this->model('Peminjaman')->approveAmbilPeminjaman($id);
        header('Location: ' . BASEURL . '/Admin');
    }
    public function tolak($id)
    {
        $this->model('Peminjaman')->tolakPeminjaman($id);
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
    public function getPeminjamanToApprove() {
        echo json_encode([ 'data' => $this->model('Peminjaman')->getPeminjamanToApprove()]);
    }
    public function getAllPeminjaman() {
        echo json_encode([ 'data' => $this->model('Peminjaman')->getAllPeminjaman()]);
    }
    public function getBarangFromPeminjaman($id) {
        $detail = $this->model('Detail_Peminjaman')->getDetailPeminjaman($id);
        $data = [];
        foreach ($detail as $key => $value) {
            $data[] = $this->model('Barang_model')->getBarangById($value['id_barang'])['nama'];
        }
        echo json_encode($data);
    }
}
?>
