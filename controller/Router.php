<?php

declare(strict_types=1);

namespace sandbox\controller;

use DI\Container;

class Router
{
    public function __construct(protected Container $container, protected array $routes = [])
    {
    }

    public function get(string $path, array|callable $fn): static
    {
        $this->routes['GET'][$path] = $fn;
        return $this;
    }

    public function post(string $path, array|callable $fn): static
    {
        $this->routes['POST'][$path] = $fn;
        return $this;
    }

    public function patch(string $path, array|callable $fn): static
    {
        $this->routes['PATCH'][$path] = $fn;
        return $this;
    }

    public function delete(string $path, array|callable $fn): static
    {
        $this->routes['DELETE'][$path] = $fn;
        return $this;
    }

    public function run()
    {
        $callable = $this->routes[$_SERVER['REQUEST_METHOD']][$_SERVER['REQUEST_URI']] ?? null;

        if (is_null($callable)) {
            exit('<h2>Page not found</h2>');
        }

        if (is_array($callable)) {
            [$class, $method] = $callable;
            if (!class_exists($class)) {
                exit('<h2>Page not found</h2>');
            }
            $class = $this->container->get($class);
            if (!method_exists($class, $method)) {
                exit('<h2>Page not found</h2>');
            }
            return call_user_func_array([$class, $method], []);
        }

        if (is_callable($callable)) {
            return call_user_func($callable);
        }

        exit('<h2>Page not found</h2>');
    }
}
