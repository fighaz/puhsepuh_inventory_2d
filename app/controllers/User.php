<?php
class User extends Controller
{
    public function index()
    {
        $data['user'] = $this->model('Barang')->getAllBarang();
        $this->view('user/index', $data);
    }
}
?>