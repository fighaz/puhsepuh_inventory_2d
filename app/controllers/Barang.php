<?php
class Barang extends Controller
{
    public $sidebar = [];
    public $active_sidebar;
    public function __construct()
    {
        parent::__construct();
        session_start();
        if ($_SESSION['role'] == 'Admin') {
            $this->sidebar = $this->sidebar_admin;
        } elseif ($_SESSION['role'] == 'User') {
            $this->sidebar = $this->sidebar_user;
        } else {
            header('Location: ' . BASEURL . '/');
        }
    }
    public function index()
    {
        $this->active_sidebar = "inventaris";
        $data['brg'] = $this->model('Barang_model')->getAllBarang();
        $this->view('admin/list_inventory', $data);
    }
    public function viewTambah()
    {
        $data['asal'] = $this->model('Kategori')->getAllKategori();
        $this->view('admin/tambahinventaris', $data);
    }
    function upload()
    {

        $namaFile = $_FILES['gambar']['name'];
        $ukuranFile = $_FILES['gambar']['size'];
        $error = $_FILES['gambar']['error'];
        $tmpName = $_FILES['gambar']['tmp_name'];
        //cek apakah tidak ada gambar yang diupload
        if ($error === 4) {
            echo "<script> alert('pilih gambar terlebih dahulu!')</script>";
            return false;
        }

        //cek apakah yang diupload adalah gambar
        $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
        $ekstensiGambar = explode('.', $namaFile);
        $ekstensiGambar = strtolower(end($ekstensiGambar));
        if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
            echo "<script> alert('yang anda upload bukan gambar')</script>";
            return false;
        }

        //cek jika ukurannya terlalu besar
        if ($ukuranFile > 10000000) {
            echo "<script> alert('Ukuran gambar terlalu besar!')</script>";
            return false;
        }
        //generate nama gambar baru
        $namaFileBaru = uniqid();
        $namaFileBaru .= '.';
        $namaFileBaru .= $ekstensiGambar;
        $dirUpload = $_SERVER['DOCUMENT_ROOT'] . '/puhsepuh_inventory_2d/public/img/' . $namaFileBaru;
        //gambar siap diupload
        exec("find /opt/lampp/htdocs/puhsepuh_inventory_2d/public/img -type d -exec chmod 0755 {} +");
        move_uploaded_file($tmpName, $dirUpload);
        return $namaFileBaru;
    }
    public function tambah()
    {
        // var_dump($_POST);
        $gambar = $this->upload();
        $validate = $_POST['tersedia'] <= $_POST['jumlah'];
        if ($validate) {
            if ($this->model('Barang_model')->tambahDataBarang($_POST, $gambar) > 0) {
                // Flasher::setFlash('berhasil', 'ditambahkan', 'success');
                header('Location: ' . BASEURL . '/Barang');
                exit;
            } else {
                // Flasher::setFlash('gagal', 'ditambahkan', 'danger');
                header('Location: ' . BASEURL . '/Barang');
                exit;
            }
        } else {
            echo "<script> alert('Barang tersedia melebihi jumlah yang diinputkan')</script>";
            $this->viewTambah();
        }

    }
    public function getAll()
    {
        $result['data'] = $this->model('Barang_model')->getAllBarang();
        echo json_encode($result);
    }
    public function detail($id)
    {
        // echo json_encode($this->model('Barang_model')->getBarangById($id));
        $barangModel = $this->model('Barang_model');
        $barang = $barangModel->getBarangById($id);

        $barang['gambar'] = BASEURL . '/img/' . $barang['gambar'];

        echo json_encode($barang);
    }
    public function getUbah($id)
    {
        $data['asal'] = $this->model('Kategori')->getAllKategori();
        $data['brg'] = $this->model('Barang_model')->getBarangById($id);
        $this->view('admin/ubahinventaris', $data);
    }
    public function ubah()
    {
        $brg = $this->model('Barang_model')->getBarangById($_POST['id']);

        if ($_FILES['gambar']['error'] === 4) {
            $gambar = $brg['gambar'];
        } else {
            $gambar = $this->upload();
        }
        $validate = $_POST['tersedia'] <= $_POST['jumlah'];
        if ($validate) {
            if ($this->model('Barang_model')->ubahDataBarang($_POST, $gambar) > 0) {
                // Flasher::setFlash('berhasil', 'diubah', 'success');
                header('Location: ' . BASEURL . '/Barang');
                exit;
            } else {
                // Flasher::setFlash('gagal', 'diubah', 'danger');
                header('Location: ' . BASEURL . '/Barang');
                exit;
            }
        } else {
            echo "<script> alert('Barang tersedia melebihi jumlah yang diinputkan')</script>";
            $this->getUbah($_POST['id']);
        }

    }
    public function hapus($id)
    {
        if ($this->model('Barang_model')->hapusDataBarang($id) > 0) {
            // Flasher::setFlash('berhasil', 'dihapus', 'success');
            header('Location: ' . BASEURL . '/Barang');
            exit;
        } else {
            // Flasher::setFlash('gagal', 'dihapus', 'danger');
            header('Location: ' . BASEURL . '/Barang');
            exit;
        }
    }
}
?>
