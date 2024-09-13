<?php
declare(strict_types=1);

namespace App;

class View
{
  public function __construct(
    protected string $relPath,
    public array $args = []
  ){}

  public static function make(string $path, array $args = []): static
  {
    return new static($path, $args);
  }

  public function render(): string
  {
    $viewPath = PATH_View . $this->relPath . '.php';
    if(! file_exists($viewPath))
    {
      throw new \App\Exceptions\ViewException('View Not Exists');
    }
    // foreach ($this->args as $key => $value) {
    //   $$key = $value;
    // }
    extract($this->args);
    ob_start();
    include $viewPath;
    return (string) ob_get_clean();
  }

  public function __toString()
  {
    return $this->render();
  }

  public function __get($name)
  {
    return $this->args[$name];
  }
}
