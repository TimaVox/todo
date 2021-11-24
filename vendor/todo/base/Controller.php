<?php
namespace Todo\base;


abstract class Controller
{
    public array $route;
    public string $controller;
    public string $model;
    public string $view;
    public string $prefix;
    public string $layout = '';
    public array $data = [];
    public array $meta = ['title' => '', 'desc' => '', 'keywords' => ''];

    public function __construct(array $route)
    {
        $this->route = $route;
        $this->controller = $route['controller'];
        $this->model = $route['controller'];
        $this->view = $route['action'];
        $this->prefix = $route['prefix'];
    }

    public function getView() : void
    {
        $viewObject = new View($this->route, $this->layout, $this->view, $this->meta);
        $viewObject->render($this->data);
    }

    public function set($data) : void
    {
        $this->data = $data;
    }

    public function setMeta($title = '', $desc = '', $keywords = '') : void
    {
        $this->meta['title'] = $title;
        $this->meta['desc'] = $desc;
        $this->meta['keywords'] = $keywords;
    }

    public function queryFilter()
    {
        $query = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
        parse_str($query, $output);
        unset($output['page']);
        return $output;
    }

    public function redirect($http = false){
        if($http){
            $redirect = $http;
        }else{
            $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : PATH;
        }
        header("Location: $redirect");
        exit;
    }
}