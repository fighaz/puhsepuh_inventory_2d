<?php
class Admin extends Controller
{
    public function index()
    {
        $data['admin'] = $this->model('Barang')->getAllBarang();
        $this->view('admin/index', $data);
    }
}
?>