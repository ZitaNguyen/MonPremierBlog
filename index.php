<?php
include 'vendor/autoload.php';

$loader = new Twig\Loader\FilesystemLoader('templates');
$twig = new Twig\Environment($loader);

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($uri) {
    case '/':
        echo $twig->render('home.html.twig');
        break;
    default:
        $template = substr($uri, 1).'.html.twig';
        echo $twig->render($template, [
            'posts' => [
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
            ]
        ]);
        break;
}


