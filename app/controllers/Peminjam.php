<?php
class Peminjam extends Controller
{
    public $sidebar = [];
    public $active_sidebar;
    public function __construct()
    {
        parent::__construct();
        session_start();
        $this->sidebar = $this->sidebar_admin;
    }
    public function index()
    {
        $data['peminjam'] = $this->model('User')->getAllPeminjam();
        $this->active_sidebar = 'peminjam';
        $this->view('admin/peminjam', $data);
    }
    public function tambah()
    {
        if ($this->model('User')->getUserByUsername($_POST['username'])) {
            Flasher::setFlash('gagal', 'Username telah dipakai', 'danger');
            header('Location: ' . BASEURL . '/Peminjam');
            exit;
        } else {
            if ($this->model('User')->tambahDataPeminjam($_POST) > 0) {
                Flasher::setFlash('berhasil', 'ditambahkan', 'success');
                header('Location: ' . BASEURL . '/Peminjam');
                exit;
            } else {
                Flasher::setFlash('gagal', 'ditambahkan', 'danger');
                header('Location: ' . BASEURL . '/Peminjam');
                exit;
            }
        }
    }
    public function detail($id)
    {
        $data['peminjam'] = $this->model('User')->getPeminjamById($id);
        $this->view('admin/peminjam', $data);
    }
    public function getNama($id) {
        echo json_encode($this->model('User')->getPeminjamById($id)['nama']);
    }
    public function getUbah()
    {
        echo json_encode($this->model('User')->getPeminjamById($_POST['id']));
    }
    public function ubah()
    {
        if ($this->model('User')->ubahDataPeminjam($_POST) > 0) {
            // Flasher::setFlash('berhasil', 'diubah', 'success');
            header('Location: ' . BASEURL . '/Peminjam');
            exit;
        } else {
            // Flasher::setFlash('gagal', 'diubah', 'danger');
            header('Location: ' . BASEURL . '/Peminjam');
            exit;
        }
    }
    public function hapus($id)
    {
        if ($this->model('User')->hapusDataPeminjam($id) > 0) {
            // Flasher::setFlash('berhasil', 'dihapus', 'success');
            header('Location: ' . BASEURL . '/Peminjam');
            exit;
        } else {
            // Flasher::setFlash('gagal', 'dihapus', 'danger');
            header('Location: ' . BASEURL . '/Peminjam');
            exit;
        }
    }
}
?>
