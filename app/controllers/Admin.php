<?php
class Admin extends Controller
{
    public $sidebar;
    public function __construct()
    {
        session_start();
        $this->sidebar = [
            [
                "id" => "home active",
                "title" => "Home",
                "icon" => "home.svg",
                "url" => "admin/index"
            ],
            [
                "id" => "inventaris",
                "title" => "Inventaris",
                "icon" => "inventaris.svg",
                "url" => "admin/index"
            ],
            [
                "id" => "peminjaman",
                "title" => "Peminjaman",
                "icon" => "peminjaman.svg",
                "url" => "admin/index"
            ],
            [
                "id" => "ganti_password",
                "title" => "Ganti Password",
                "icon" => "kunci.svg",
                "url" => "admin/index"
            ]
        ];
    }
    public function index()
    {
        // $data['admin'] = $this->model('Peminjaman')->getPeminjamanToApprove();
        $data['sidebar'] = $this->sidebar;
        $this->view('admin/index');
    }
    public function peminjaman()
    {
        $data['admin'] = $this->model('Peminjaman')->getAllPeminjaman();
        $data['sidebar'] = $this->sidebar;
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
        $data['sidebar'] = $this->sidebar;
        $this->view('admin/peminjaman', $data);
    }
    public function cari()
    {
        $data['barang'] = $this->model('Barang')->cariDataBarang();
        $data['sidebar'] = $this->sidebar;
        $this->view('barang/index', $data);
    }

}
?>
