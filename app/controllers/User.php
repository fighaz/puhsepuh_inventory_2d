<?php
class User extends Controller
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
    public function index()
    {
        $data['sidebar'] = $this->sidebar;
        $this->view('user/index', $data);
    }
    public function addCart($id)
    {
        if (array_key_exists($id, $_SESSION['cart'])) {
            http_response_code(400);
        } else {
            $_SESSION['cart'][$id] = $id;
            http_response_code(200);
        }

    }
    public function removeFromCart($id)
    {
        if (array_key_exists($id, $_SESSION['cart'])) {
            unset($_SESSION['cart'][$id]);
            http_response_code(200);
        } else {
            http_response_code(400);
        }
    }
    public function getCart()
    {
        echo json_encode($_SESSION['cart']);
    }
    public function tambah()
    {
        $peminjaman = $this->model('Peminjaman')->tambahDataPeminjaman($_POST);
        if ($peminjaman > 0) {
            $this->model('Detail_Peminjaman')->tambahDataPeminjaman($_POST, $peminjaman);
            unset($_SESSION['cart']);
            // Flasher::setFlash('berhasil', 'ditambahkan', 'success');
            header('Location: ' . BASEURL . '/User');
            exit;
        } else {
            // Flasher::setFlash('gagal', 'ditambahkan', 'danger');
            header('Location: ' . BASEURL . '/User');
            exit;
        }
    }
    public function peminjaman()
    {
        $data = $this->model('Peminjaman')->getPeminjamanByUserId($_SESSION['iduser']);
        $this->view('user/peminjaman', $data);
    }
    public function detailPeminjaman($id)
    {
        $data['detail'] = $this->model('Detail_Peminjaman')->getDetailPeminjaman($id);
        $this->view('user/peminjaman', $data);
    }
}
?>