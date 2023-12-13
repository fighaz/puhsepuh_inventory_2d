<?php
class UbahPassword extends Controller
{
    public function __construct()
    {
        session_start();
    }
    public function index()
    {
        if (isset($_SESSION['id_user'])) {
            $this->view('ganti_password');
        } else {
            header('Location: ' . BASEURL . '/');
        }

    }
    public function ubah()
    {
        $passwordlama = strip_tags(htmlspecialchars($_POST['password_lama'], ENT_QUOTES));
        $passwordbaru = strip_tags(htmlspecialchars($_POST['password_baru'], ENT_QUOTES));
        $passwordkonfirm = strip_tags(htmlspecialchars($_POST['konfirm_password'], ENT_QUOTES));
        $konfirm = $passwordbaru == $passwordkonfirm;
        $user = $this->model('User')->getUserByUsername($_SESSION['username']);
        if ($user && password_verify($passwordlama, $user['password'])) {
            if ($konfirm) {
                if ($this->model('User')->changePassword($passwordkonfirm, $_SESSION['id_user']) > 0) {
                    // Flasher::setFlash('berhasil', 'ditambahkan', 'success');
                    header('Location: ' . BASEURL . '/' . $_SESSION['role']);
                } else {
                    // Flasher::setFlash('gagal', 'diubah', 'danger');
                    header('Location: ' . BASEURL . '/UbahPassword');
                }
            } else {
                echo "<script> alert('Masukkan Konfirmasi Password yang sesuai')</script>";
            }
        } else {
            echo "<script> alert('Masukkan Password yang sesuai')</script>";
        }

    }
}
?>