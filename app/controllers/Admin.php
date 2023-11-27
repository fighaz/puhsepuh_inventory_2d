<?php
class Admin extends Controller
{
    public function index()
    {
        $data['admin'] = $this->model('Peminjaman')->getAllPeminjaman();
        $this->view('admin/index', $data);
    }
}
?>