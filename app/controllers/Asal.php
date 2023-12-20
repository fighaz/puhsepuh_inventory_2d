<?php
class Asal extends Controller {
    public $sidebar = [];
    public $active_sidebar;
    public function __construct()
    {
        parent::__construct();

        session_start();
        if (!isset($_SESSION['role'])) {
            header('Location: ' . BASEURL . '/');
        } else if ($_SESSION['role'] != 'Admin') {
            header("HTTP/1.1 403 Forbidden");
            die();
        }
        $this->sidebar = $this->sidebar_admin;
    }
    public function index() {
        $data['asal'] = $this->model('Kategori')->getAllKategori();
        $this->view('admin/AsalKategori', $data);
    }
    public function tambah() {
        if($this->model('Kategori')->tambahDataKategori($_POST) > 0) {
            Flasher::setFlash('berhasil', 'ditambahkan', 'success');
            header('Location: '.BASEURL.'/Asal');
            exit;
        } else {
            Flasher::setFlash('gagal', 'ditambahkan', 'danger');
            header('Location: '.BASEURL.'/Asal');
            exit;
        }
    }

    public function hapus($id) {
        if($this->model('Kategori')->hapusDataKategori($id) > 0) {
            Flasher::setFlash('berhasil', 'dihapus', 'success');
            header('Location: '.BASEURL.'/Asal');
            exit;
        } else {
            Flasher::setFlash('gagal', 'dihapus', 'danger');
            header('Location: '.BASEURL.'/Asal');
            exit;
        }
    }
}
?>
