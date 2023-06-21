<?php

namespace App\Controllers;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class AbstractController
{
    protected $twig;

    public function __construct()
    {
        $loader = new FilesystemLoader('templates');
        $this->twig = new Environment($loader);
        $this->twig->addGlobal('session', $_SESSION);
    }

    public function unsetSession()
    {
        unset($_SESSION['message']);
        unset($_SESSION['error_level']);
    }
}