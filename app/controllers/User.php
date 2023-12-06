<?php
class User extends Controller
{
    public function __construct()
    {
        session_start();
        $_SESSION['cart'] = array();
    }
    public function index()
    {
        $data['user'] = $this->model('Barang')->getAllBarang();
        $this->view('user/index', $data);
    }
    public function addCart($id)
    {
        $_SESSION['cart'][] = $id;

    }
    public function getCart()
    {
        echo json_encode($_SESSION['cart']);
    }
    public function removeFromCart($id)
    {
        for ($i = 0; $i < count($_SESSION['cart']); $i++) {
            if ($_SESSION['cart'][$i] == $id) {
                unset($_SESSION['cart'][$i]);
            }
        }
    }
    public function tambah()
    {
        if ($this->model('Peminjaman')->tambahDataMahasiswa($_POST) > 0) {
            $this->model('Detail_Peminjaman')->tambahDataPeminjaman($_POST);
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