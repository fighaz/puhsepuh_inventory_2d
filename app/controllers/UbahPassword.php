<?php
class UbahPassword extends Controller
{
    public $sidebar = [];
    public $active_sidebar;
    public function __construct()
    {
        parent::__construct();
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
        if (isset($_SESSION['id_user'])) {
            $this->active_sidebar = "ganti_password";
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
                    Flasher::setFlash('berhasil', 'diubah', 'success');
                    $_SESSION['has_changed_password'] = true;
                    header('Location: ' . BASEURL . '/UbahPassword');
                } else {
                    Flasher::setFlash('gagal', 'diubah', 'danger');
                    header('Location: ' . BASEURL . '/UbahPassword');
                }
            } else {
                Flasher::setFlash('gagal', 'diubah', 'danger');
                echo "<script> alert('Masukkan Konfirmasi Password yang sesuai')</script>";
                header('Location: ' . BASEURL . '/UbahPassword');
            }
        } else {
            echo "<script> alert('Masukkan Password yang sesuai')</script>";
            Flasher::setFlash('gagal', 'diubah', 'danger');
            header('Location: ' . BASEURL . '/UbahPassword');
        }

    }
}
?>
