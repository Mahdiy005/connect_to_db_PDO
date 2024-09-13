<?php

declare(strict_types=1);
namespace App;

class Router
{
  private array $routes = [];
  public function register(string $methodType, string $route, callable|array $target): self
  {
    $this->routes[$methodType][$route] = $target;
    return $this;
  }

  public function get(string $route, callable|array $target): self
  {
    return $this->register('get', $route, $target);
  }

  public function post(string $route, callable|array $target): self
  {
    return $this->register('post', $route, $target);
  }

  public function routes(): array
  {
    return $this->routes();
  }

  public function resolve()
  {
    $route = explode('?', $_SERVER['REQUEST_URI'])[0];
    $methodType = strtolower($_SERVER['REQUEST_METHOD']);
    $target = $this->routes[$methodType][$route] ?? null;
    if(! isset($target))
    {
      throw new \Exception('404 No Such Page');
    }

    if(is_callable($target)){
      return call_user_func($target);
    }
    if(is_array($target))
    {
      [$class, $method] = $target;
      if(class_exists($class))
      {
        $class = new $class();
        if(method_exists($class, $method))
        {
          call_user_func_array($method, []);
        }
      }
    }
    return call_user_func($target);
  }
}
