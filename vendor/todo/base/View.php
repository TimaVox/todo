<?php

namespace Todo\base;

class View
{
    public array $route;
    public string $controller;
    public string $model;
    public string $view;
    public string $prefix;
    public string $layout;
    public array $data = [];
    public array $meta = [];

    public function __construct($route, $layout = '', $view = '', $meta)
    {
        $this->route = $route;
        $this->controller = lcfirst($route['controller']);
        $this->view = $view;
        $this->model = $route['controller'];
        $this->prefix = lcfirst($route['prefix']);
        $this->meta = $meta;
        $this->layout = $layout ?: 'default';
    }

    public function render($data) : void
    {
        if(is_array($data)) extract($data);
        $viewFile = ROOT . "/app/views/{$this->prefix}{$this->controller}/{$this->view}.php";

        if(is_file($viewFile)){
            ob_start();
            require_once $viewFile;
            $content = ob_get_clean();
        }else{
            throw new \Exception("Не найден вид {$viewFile}", 500);
        }

        $layoutFile = ROOT . "/app/views/layouts/{$this->layout}.php";
        if(is_file($layoutFile)){
            require_once $layoutFile;
        }else{
            throw new \Exception("Не найден шаблон {$this->layout}", 500);
        }

    }

    public function getMeta() : string
    {
        $output = '<title>' . $this->meta['title'] . '</title>' . PHP_EOL;
        $output .= '<meta name="description" content="' . $this->meta['desc'] . '">' . PHP_EOL;
        $output .= '<meta name="keywords" content="' . $this->meta['keywords'] . '">' . PHP_EOL;
        return $output;
    }
}