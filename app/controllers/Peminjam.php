<?php
class Peminjam extends Controller
{
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
    public function tambahUser()
    {
        if ($this->model('User')->getUserByUsername($_POST['username'])) {
            $response['status'] = 'gagal';
            $response['message'] = 'Username telah dipakai';
            echo json_encode($response);
            http_response_code(400);
        } else {
            if ($this->model('User')->tambahDataPeminjam($_POST) > 0) {
                $response['status'] = 'berhasil';
                $response['message'] = 'Data Peminjam berhasil ditambahkan!';
                echo json_encode($response);
                http_response_code(200);
            } else {
                $response['status'] = 'gagal';
                $response['message'] = 'Data Peminjam gagal ditambahkan!';
                echo json_encode($response);
                http_response_code(400);
            }
        }
    }
    public function detail($id)
    {
        $data['peminjam'] = $this->model('User')->getPeminjamById($id);
        $this->view('admin/peminjam', $data);
    }
    public function getDetail($id)
    {
        try {
            echo json_encode($this->model('User')->getPeminjamById($id));
            http_response_code(200);
        } catch (Exception $e) {
            echo json_encode($e);
            http_response_code(400);
        }
    }
    public function getAll()
    {
        echo json_encode(['data' => $this->model('User')->getAllPeminjam()]);
    }
    public function getNama($id)
    {
        echo json_encode($this->model('User')->getPeminjamById($id)['nama']);
    }
    public function getUbah()
    {
        echo json_encode($this->model('User')->getPeminjamById($_POST['id']));
    }
    public function ubah()
    {
        if ($this->model('User')->ubahDataPeminjam($_POST) > 0) {
            Flasher::setFlash('berhasil', 'diubah', 'success');
            header('Location: ' . BASEURL . '/Peminjam');
            exit;
        } else {
            Flasher::setFlash('gagal', 'diubah', 'danger');
            header('Location: ' . BASEURL . '/Peminjam');
            exit;
        }
    }
    public function hapus($id)
    {
        if ($this->model('User')->hapusDataPeminjam($id) > 0) {
            Flasher::setFlash('berhasil', 'dihapus', 'success');
            header('Location: ' . BASEURL . '/Peminjam');
            exit;
        } else {
            Flasher::setFlash('gagal', 'dihapus', 'danger');
            header('Location: ' . BASEURL . '/Peminjam');
            exit;
        }
    }
    public function resetPassword($id)
    {
        if ($this->model('User')->resetPassword($id) > 0) {
            Flasher::setFlash('berhasil', 'reset', 'success');
            header('Location: ' . BASEURL . '/Peminjam');
            exit;
        } else {
            Flasher::setFlash('gagal', 'reset', 'danger');
            header('Location: ' . BASEURL . '/Peminjam');
            exit;
        }
    }
}
?>