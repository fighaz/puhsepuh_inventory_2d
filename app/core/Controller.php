<?php
class Controller
{
    public $sidebar_user;
    public $sidebar_admin;
    public $active_sidebar;

    public function __construct()
    {
        $this->sidebar_user = [
            [
                "id" => "home",
                "title" => "Home",
                "icon" => "home.svg",
                "url" => "user/index"
            ],
            [
                "id" => "peminjaman",
                "title" => "Peminjaman",
                "icon" => "peminjaman.svg",
                "url" => "user/peminjaman"
            ],
            [
                "id" => "ganti_password",
                "title" => "Ganti Password",
                "icon" => "kunci.svg",
                "url" => "user/ganti_password"
            ]
        ];

        $this->sidebar_admin = [
            [
                "id" => "home",
                "title" => "Home",
                "icon" => "home.svg",
                "url" => "admin/index"
            ],
            [
                "id" => "inventaris",
                "title" => "Inventaris",
                "icon" => "inventaris.svg",
                "url" => "admin/inventaris"
            ],
            [
                "id" => "peminjaman",
                "title" => "Peminjaman",
                "icon" => "peminjaman.svg",
                "url" => "admin/peminjaman"
            ],
            [
                "id" => "ganti_password",
                "title" => "Ganti Password",
                "icon" => "kunci.svg",
                "url" => "admin/ganti_password"
            ]
        ];
    }
    public function view($view, $data = [])
    {
        require_once '../app/views/templates/header.php';
        require_once '../app/views/templates/nav_and_sidebar_head.php';
        require_once '../app/views/' . $view . '.php';
        require_once '../app/views/templates/nav_and_sidebar_foot.php';
        require_once '../app/views/templates/footer.php';
    }
    public function model($model)
    {
        require_once '../app/models/' . $model . '.php';
        return new $model;
    }
    public function viewWithoutTemplate($view, $data = [])
    {
        require_once '../app/views/' . $view . '.php';
    }
}
