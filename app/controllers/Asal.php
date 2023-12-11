<?php
class Asal extends Controller {
    public function index() {
        $data['asal'] = $this->model('Kategori')->getAllKategori();
        $this->view('', $data);
    }
    public function tambah() {
        if($this->model('Kategori')->tambahDataKategori($_POST) > 0) {
            Flasher::setFlash('berhasil', 'ditambahkan', 'success');
            header('Location: '.BASEURL.'/Barang');
            exit;
        } else {
            Flasher::setFlash('gagal', 'ditambahkan', 'danger');
            header('Location: '.BASEURL.'/Barang');
            exit;
        }
    }

    public function hapus($id) {
        if($this->model('Kategori')->hapusDataKategori($id) > 0) {
            Flasher::setFlash('berhasil', 'dihapus', 'success');
            header('Location: '.BASEURL.'/Barang');
            exit;
        } else {
            Flasher::setFlash('gagal', 'dihapus', 'danger');
            header('Location: '.BASEURL.'/Barang');
            exit;
        }
    }
}
?>