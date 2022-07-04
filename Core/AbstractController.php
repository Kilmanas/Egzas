<?php
namespace Core;

use Helper\Url;

use const PROJECT_ROOT_DIR;

class AbstractController
{
    public function render(string $template): void
    {
        include_once PROJECT_ROOT_DIR . '/design/parts/header.php';
        include_once PROJECT_ROOT_DIR . '/design/' . $template . '.php';
    }
    public function url(string $path, ?string $param = null): string
    {
        return Url::link($path, $param);
    }
}