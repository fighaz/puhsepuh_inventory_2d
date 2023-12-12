<?php
class User extends Controller
{

    public $sidebar;

    public function __construct()
    {
        parent::__construct();
        session_start();
        $this->sidebar = $this->sidebar_user;
    }
    public function index()
    {
        $this->active_sidebar = "home";
        $this->view('user/index');
    }
    public function addCart($id)
    {
        if ($this->model('Keranjang')->tambahItemKeranjang($_SESSION['id_user'], $id) > 0) {
            // Flasher::setFlash('berhasil', 'ditambahkan', 'success');
            header('Location: ' . BASEURL . '/User');
            exit;
        } else {
            // Flasher::setFlash('gagal', 'ditambahkan', 'danger');
            header('Location: ' . BASEURL . '/User');
            exit;
        }

    }
    public function removeFromCart($id)
    {
        if ($this->model('Keranjang')->hapusItemKeranjangByUserId($_SESSION['id_user'], $id) > 0) {
            // Flasher::setFlash('berhasil', 'ditambahkan', 'success');
            header('Location: ' . BASEURL . '/User');
            exit;
        } else {
            // Flasher::setFlash('gagal', 'ditambahkan', 'danger');
            header('Location: ' . BASEURL . '/User');
            exit;
        }
    }
    public function getCart()
    {
        echo json_encode($this->model('Keranjang')->getAllKeranjangByUserId());
    }
    public function tambah()
    {
        $data = json_decode($_POST['barang']);
        $peminjaman = $this->model('Peminjaman')->tambahDataPeminjaman($data, $_SESSION['id_user']);
        if ($peminjaman > 0) {
            $this->model('Detail_Peminjaman')->tambahDataPeminjaman($data, $peminjaman);
            $this->model('Keranjang')->hapusDataKeranjangByUserId($_SESSION['id_user']);
            // Flasher::setFlash('berhasil', 'ditambahkan', 'success');
            header('Location: ' . BASEURL . '/User');
            exit;
        } else {
            // Flasher::setFlash('gagal', 'ditambahkan', 'danger');
            header('Location: ' . BASEURL . '/User');
            exit;
        }
    }
    public function proses()
    {
        $this->active_sidebar = "home";
        $this->view('user/proses');
    }
    public function peminjaman()
    {
        $this->active_sidebar = "peminjaman";
        //$data = $this->model('Peminjaman')->getPeminjamanByUserId($_SESSION['iduser']);
        //$this->view('user/peminjaman', $data);
        $this->view('user/riwayat');
    }
    public function detailPeminjaman($id)
    {
        $data['detail'] = $this->model('Detail_Peminjaman')->getDetailPeminjaman($id);
        $this->view('user/peminjaman', $data);
    }
}
?>