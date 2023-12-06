<?php
class Barang extends Controller
{
    public function index()
    {
        // $data['brg'] = $this->model('Barang')->getAllPeminjaman();
        $this->view('admin/list_inventory');
    }
    public function tambah()
    {
        if ($this->model('Barang')->tambahDataBarang($_POST) > 0) {
            // Flasher::setFlash('berhasil', 'ditambahkan', 'success');
            header('Location: ' . BASEURL . '/Barang');
            exit;
        } else {
            // Flasher::setFlash('gagal', 'ditambahkan', 'danger');
            header('Location: ' . BASEURL . '/Barang');
            exit;
        }
    }
    public function detail($id)
    {
        $data['admin'] = $this->model('Barang')->getBarangById($id);
    }
    public function getUbah()
    {
        echo json_encode($this->model('Barang')->getBarangById($_POST['id']));
    }
    public function ubah()
    {
        if ($this->model('Barang')->ubahDataBarang($_POST) > 0) {
            // Flasher::setFlash('berhasil', 'diubah', 'success');
            header('Location: ' . BASEURL . '/Barang');
            exit;
        } else {
            // Flasher::setFlash('gagal', 'diubah', 'danger');
            header('Location: ' . BASEURL . '/Barang');
            exit;
        }
    }
    public function hapus($id)
    {
        if ($this->model('Barang')->hapusDataBarang($id) > 0) {
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