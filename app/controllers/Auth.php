<?php
class Auth extends Controller
{
    public function index()
    {
        $this->viewWithoutTemplate('Login');
    }
    public function login()
    {
        $username = strip_tags(htmlspecialchars($_POST['username'], ENT_QUOTES));
        $password = strip_tags(htmlspecialchars($_POST['password'], ENT_QUOTES));
        $user = $this->model('User')->getUserByUsername($username);
        if ($user && password_verify($password, $user['password'])) {
            // Login successful

            $_SESSION['id_user'] = $user['id'];
            $_SESSION['nama'] = $user['nama'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['login_success'] = true;
            if ($user['isChangePassword'] == 0) {
                $_SESSION['has_changed_password'] = false;
            } else {
                $_SESSION['has_changed_password'] = true;
            }
            header('Location: ' . BASEURL . '/' . $_SESSION['role']);
        } else {
            $_SESSION['login_success'] = false;
            header('Location: ' . BASEURL . '/');
        }
    }
    public function logout()
    {
        session_destroy();
        header('Location: ' . BASEURL . '/');
        exit;
    }

}
