<?php 
class Login extends Controller {
    public function index($data = []) {
        $this->view('Login', $data);
    }
}
