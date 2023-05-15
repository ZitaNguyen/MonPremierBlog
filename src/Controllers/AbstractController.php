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
    }
}