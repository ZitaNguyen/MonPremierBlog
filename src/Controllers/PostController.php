<?php

namespace App\Controllers\PostController;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class PostController
{
    public function getPosts()
    {
        $loader = new FilesystemLoader('templates');
        $twig = new Environment($loader);
        $posts = [
            [
                'title' => 'Post1',
                'excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe nostrum ullam eveniet pariatur voluptates odit, fuga atque ea nobis sit soluta odio, adipisci quas excepturi maxime quae totam ducimus consectetur?',
                'content' => '                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe nostrum ullam eveniet pariatur voluptates odit, fuga atque ea nobis sit soluta odio, adipisci quas excepturi maxime quae totam ducimus consectetur?
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe nostrum ullam eveniet pariatur voluptates odit, fuga atque ea nobis sit soluta odio, adipisci quas excepturi maxime quae totam ducimus consectetur',
                'author' => 'Zita',
                'create_date' => '2023-01-01'
            ],
            [
                'title' => 'Post2',
                'excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe nostrum ullam eveniet pariatur voluptates odit, fuga atque ea nobis sit soluta odio, adipisci quas excepturi maxime quae totam ducimus consectetur?',
                'content' => '                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe nostrum ullam eveniet pariatur voluptates odit, fuga atque ea nobis sit soluta odio, adipisci quas excepturi maxime quae totam ducimus consectetur?
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe nostrum ullam eveniet pariatur voluptates odit, fuga atque ea nobis sit soluta odio, adipisci quas excepturi maxime quae totam ducimus consectetur',
                'author' => 'Zita',
                'create_date' => '2023-01-01'
            ]
        ];
        echo $twig->render('posts.html.twig', ['posts' => $posts]);
    }
}