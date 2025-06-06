<?php

namespace App\Kernel\View;

use App\Kernel\Exceptons\FileNotFoundException;
use App\Kernel\Session\SessionInterface;

class View implements ViewInterface
{
    public function __construct(private SessionInterface $session)
    {
    }

    public function page(string $name): void
    {
        $viewPath = APP_PATH . "/views/pages/$name.php";

        if (!file_exists($viewPath)) {
            throw new FileNotFoundException("View $name not found");
        }


        extract([
            'view' => $this,
            'session' => $this->session
        ]);


        include_once $viewPath;
    }

    public function component(string $name): void
    {
        $componentPath =  APP_PATH . "/views/components/$name.php";

        if (!file_exists($componentPath)) {
            echo "Component $name not found";
            return;
        }

        include_once $componentPath;
    }
}
