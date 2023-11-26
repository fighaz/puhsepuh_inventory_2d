<?php

class App
{
    protected $controller = 'Login';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->parseURL();

        if (isset($_SESSION)) {
            $this->setController($_SESSION["role"], $url);
        } else {
            if ($url == NULL) {
                $url[0] = $this->controller;
            }
        }


        require_once '../app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        // method
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        // params
        if (!empty($url)) {
            $this->params = array_values($url);
        }

        // jalankan controller & method, serta kirimkan params jika ada
        call_user_func_array([$this->controller, $this->method], $this->params);




    }
    public function setController($role, $url)
    {
        if ($url == NULL) {

            $this->controller = $_SESSION["role"];
            $url[0] = $this->controller;
        } else {
            // controller
            if (file_exists('../app/controllers/' . $url[0] . '.php')) {
                $this->controller = $url[0];
                unset($url[0]);
            }
        }
    }
    public function parseURL()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            // Supaya bersih dari karakter karakter aneh
            $url = explode('/', $url);
            // pecah urlnya berdasarkan tanda /  menggunakan explode
            return $url;
        }
    }
}
