<?php

namespace App\Controllers\HomeController;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class HomeController
{
    public function displayHomePage()
    {
        $loader = new FilesystemLoader('templates');
        $twig = new Environment($loader);
        $post = [
            'title' => 'Post1',
            'excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe nostrum ullam eveniet pariatur voluptates odit, fuga atque ea nobis sit soluta odio, adipisci quas excepturi maxime quae totam ducimus consectetur?',
            'content' => '                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe nostrum ullam eveniet pariatur voluptates odit, fuga atque ea nobis sit soluta odio, adipisci quas excepturi maxime quae totam ducimus consectetur?
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe nostrum ullam eveniet pariatur voluptates odit, fuga atque ea nobis sit soluta odio, adipisci quas excepturi maxime quae totam ducimus consectetur',
            'author' => 'Zita',
            'create_date' => '2023-01-01'
        ];
        echo $twig->render('home.html.twig', ['post' => $post]);
    }
}
