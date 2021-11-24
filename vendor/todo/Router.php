<?php

namespace Todo;

use http\Exception;

class Router
{
    protected static array $routes = [];
    protected static array $route = [];
    public static string $namespace = 'App\controllers\\';

    public static function add($regexp, $route = []) : void
    {
        self::$routes[$regexp] = $route;
    }

    public static function getRoutes() : array
    {
        return self::$routes;
    }

    public static function getRoute() : array
    {
        return self::$route;
    }

    public static function dispatch($url) : void
    {
        $url = self::removeQueryString($url);
        if(self::matchRoute($url)) {
            $prefix = !empty(self::$route['prefix']) ?
                preg_replace('/\/$/', '\\',  self::$route['prefix']) : '';

            $controller = self::$namespace . $prefix . self::$route['controller'] . 'Controller';
            if(class_exists($controller)){
                $controllerObject = new $controller(self::$route);
                $action = self::lowerCamelCase(self::$route['action']) . 'Action';
                if(method_exists($controllerObject, $action)) {
                    $controllerObject->$action();
                    $controllerObject->getView();
                    unset($_SESSION['errors']);
                    unset($_SESSION['success']);
                } else {
                    throw new \Exception("Метод $controller::$action не найден", 404);
                }
            } else {
                throw new \Exception("Контроллер $controller не найден", 404);
            }
        } else {
            throw new \Exception('Страница не найдена!', 404);
        }
    }

    public static function matchRoute($url) : bool
    {
        foreach (self::$routes as $pattern => $route) {
            if (preg_match("#{$pattern}#", $url, $matches)) {
                $route = array_merge($route,
                    array_filter($matches, "is_string", ARRAY_FILTER_USE_KEY));

                $route['action'] = $route['action'] ?? 'index';
                $route['prefix'] = isset($route['prefix']) ? $route['prefix'] . DIRECTORY_SEPARATOR : '';
                $route['controller'] = self::upperCamelCase($route['controller']);
                self::$route = $route;
                return true;

            }
        }
        return false;
    }

    protected static function upperCamelCase($name) : string
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $name)));
    }

    protected static function lowerCamelCase($name) : string
    {
        return lcfirst(self::upperCamelCase($name));
    }

    protected static function removeQueryString($url)
    {
        if($url){
            $params = explode('&', $url, 2);
            if(false === strpos($params[0], '=')){
                return rtrim($params[0], '/');
            }else{
                return '';
            }
        }
    }
}