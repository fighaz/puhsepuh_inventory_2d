<?php
class User extends Controller {
    public $sidebar;
    public function __construct() {
        session_start();
        $this->sidebar = [
            [
                "id" => "home active",
                "title" => "Home",
                "icon" => "home.svg",
                "url" => "user/index"
            ],
            [
                "id" => "inventaris",
                "title" => "Inventaris",
                "icon" => "inventaris.svg",
                "url" => "user/index"
            ],
            [
                "id" => "peminjaman",
                "title" => "Peminjaman",
                "icon" => "peminjaman.svg",
                "url" => "user/index"
            ],
            [
                "id" => "ganti_password",
                "title" => "Ganti Password",
                "icon" => "kunci.svg",
                "url" => "user/index"
            ]
        ];
    }
    public function index() {
        $data['sidebar'] = $this->sidebar;
        $this->view('user/index', $data);
    }
    public function addCart($id) {
        if($this->model('Keranjang')->tambahItemKeranjang($id) > 0) {
            // Flasher::setFlash('berhasil', 'ditambahkan', 'success');
            header('Location: '.BASEURL.'/User');
            exit;
        } else {
            // Flasher::setFlash('gagal', 'ditambahkan', 'danger');
            header('Location: '.BASEURL.'/User');
            exit;
        }

    }
    public function removeFromCart($id) {
        if($this->model('Keranjang')->hapusItemKeranjangByUserId($_SESSION['id_user'], $id) > 0) {
            // Flasher::setFlash('berhasil', 'ditambahkan', 'success');
            header('Location: '.BASEURL.'/User');
            exit;
        } else {
            // Flasher::setFlash('gagal', 'ditambahkan', 'danger');
            header('Location: '.BASEURL.'/User');
            exit;
        }
    }
    public function getCart() {
        echo json_encode($this->model('Keranjang')->getAllKeranjangByUserId());
    }
    public function tambah() {
        $peminjaman = $this->model('Peminjaman')->tambahDataPeminjaman($_POST);
        if($peminjaman > 0) {
            $this->model('Detail_Peminjaman')->tambahDataPeminjaman($_POST, $peminjaman);
            $this->model('Keranjang')->hapusDataKeranjangByUserId($_SESSION['id_user']);
            // Flasher::setFlash('berhasil', 'ditambahkan', 'success');
            header('Location: '.BASEURL.'/User');
            exit;
        } else {
            // Flasher::setFlash('gagal', 'ditambahkan', 'danger');
            header('Location: '.BASEURL.'/User');
            exit;
        }
    }
    public function proses()
    {
        $data['sidebar'] = $this->sidebar;
        $this->view('user/proses', $data);
    }
    public function peminjaman()
    {
        $data = $this->model('Peminjaman')->getPeminjamanByUserId($_SESSION['iduser']);
        $this->view('user/peminjaman', $data);
    }
    public function detailPeminjaman($id) {
        $data['detail'] = $this->model('Detail_Peminjaman')->getDetailPeminjaman($id);
        $this->view('user/peminjaman', $data);
    }
}
?>
