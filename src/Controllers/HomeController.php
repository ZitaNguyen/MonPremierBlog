<?php

namespace App\Controllers;

use App\Models\PostModel;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class HomeController
{
    public function displayHomePage()
    {
        $loader = new FilesystemLoader('templates');
        $twig = new Environment($loader);
        $postModel  = new PostModel;

        $post = $postModel->getLastPost();
        echo $twig->render('home.html.twig', ['post' => $post]);
    }
}
