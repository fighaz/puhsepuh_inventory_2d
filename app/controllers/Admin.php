<?php
class Admin extends Controller
{
    public $sidebar;
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
    public function peminjaman($id = null, $text = null)
    {
        //$data['admin'] = $this->model('Peminjaman')->getAllPeminjaman();
        $this->active_sidebar = "peminjaman";
        $data['id_tab'] = $id;
        $data['text_tab'] = $text;
        $this->view('admin/riwayat_peminjaman', $data);
    }
    public function peminjam()
    {
        $this->active_sidebar = "peminjam";
        $this->view('admin/peminjam');
    }
    public function approve($id)
    {
        $this->model('Peminjaman')->approvePeminjaman($id);
        $http_referer = $_SERVER['HTTP_REFERER'];
        if ($http_referer == BASEURL . '/Admin/peminjaman') {
            header('Location: ' . $http_referer . '/' . $_GET['id_tab'] . '/' . $_GET['text_tab']);
        } else {
            header('Location: ' . $http_referer);
        }
    }
    public function approveAmbil($id)
    {
        $this->model('Peminjaman')->approveAmbilPeminjaman($id);
        $http_referer = $_SERVER['HTTP_REFERER'];
        if ($http_referer == BASEURL . '/Admin/peminjaman') {
            header('Location: ' . $http_referer . '/' . $_GET['id_tab'] . '/' . $_GET['text_tab']);
        } else {
            header('Location: ' . $http_referer);
        }
    }
    public function tolak($id)
    {
        $this->model('Peminjaman')->tolakPeminjaman($id);
        $http_referer = $_SERVER['HTTP_REFERER'];
        if ($http_referer == BASEURL . '/Admin/peminjaman') {
            header('Location: ' . $http_referer . '/' . $_GET['id_tab'] . '/' . $_GET['text_tab']);
        } else {
            header('Location: ' . $http_referer);
        }
    }
    public function pinjamSelesai($id)
    {
        $this->model('Peminjaman')->peminjamanSelesai($id);
        $http_referer = $_SERVER['HTTP_REFERER'];
        if ($http_referer == BASEURL . '/Admin/peminjaman') {
            header('Location: ' . $http_referer . '/' . $_GET['id_tab'] . '/' . $_GET['text_tab']);
        } else {
            header('Location: ' . $http_referer);
        }
    }
    public function detailPeminjaman($id)
    {
        $data['peminjaman'] = $this->model('Peminjaman')->getDetailPeminjaman($id);
        $this->view('admin/detail_peminjaman', $data);
    }
    public function ubahPeminjaman($id)
    {
        $data['peminjaman'] = $this->model('Peminjaman')->getDetailPeminjaman($id);
        $this->view('admin/ubah_peminjaman', $data);
    }
    public function cari()
    {
        $data['barang'] = $this->model('Barang')->cariDataBarang();
        $this->view('barang/index', $data);
    }
    public function getPeminjamanToApprove()
    {
        echo json_encode(['data' => $this->model('Peminjaman')->getPeminjamanToApprove()]);
    }
    public function getAllPeminjaman()
    {
        echo json_encode(['data' => $this->model('Peminjaman')->getAllPeminjaman()]);
    }
    public function getBarangFromPeminjaman($id)
    {
        $detail = $this->model('Detail_Peminjaman')->getDetailPeminjaman($id);
        $data = [];
        foreach ($detail as $key => $value) {
            $data[] = $this->model('Barang_model')->getBarangById($value['id_barang'])['nama'];
        }
        echo json_encode($data);
    }
    public function getDetailBarangFromPeminjaman($id)
    {
        $result['data'] = $this->model('Peminjaman')->getDetailBarangById($id);
        echo json_encode($result);
    }
    public function rincianPeminjaman($id)
    {
        $data['detail'] = $this->model('Detail_Peminjaman')->getDetailPeminjaman($id);
        $this->view('admin/rincian_peminjaman', $data);
    }
}
?>
