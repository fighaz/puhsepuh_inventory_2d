<?php
class Auth extends Controller
{
    public function index()
    {
        $this->view('Login');
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
            $_SESSION['role'] = $user['role'];
            header('Location: ' . BASEURL . '/' . $user['role']);
            exit;
        } else {
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
