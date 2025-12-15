<?php

class Router {
    private array $routes = [];

    public function add(string $method, string $path, Closure $handler): void {
        $method = strtoupper($method);
        $this->routes[$method][$path] = $handler;
    }

    public function get(string $path, Closure $handler): void {
        $this->add('GET', $path, $handler);
    }

    public function post(string $path, Closure $handler): void {
        $this->add('POST', $path, $handler);
    }

    public function dispatch(string $path, string $method): void {
        $method = strtoupper($method);

        if (!isset($this->routes[$method])) {
            echo "405 Method Not Allowed";
            return;
        }

        foreach ($this->routes[$method] as $route => $handler) {
            // reemplaza {param} por un grupo de captura
            $pattern = preg_replace("#\{(\w+)\}#", "([^/]+)", $route);

            // compara contra la ruta actual
            if (preg_match("#^$pattern$#", $path, $matches)) {
                array_shift($matches);
                call_user_func_array($handler, $matches);
                return;
            }
        }

        echo "404 Not Found";
    }
}
