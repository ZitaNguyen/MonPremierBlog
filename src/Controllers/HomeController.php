<?php

namespace App\Controllers\HomeController;

require_once('src/Library/Database.php');
require_once('src/Models/PostModel.php');

use App\Library\Database\DatabaseConnection;
use App\Model\PostModel\PostModel;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class HomeController
{
    public function displayHomePage()
    {
        $loader = new FilesystemLoader('templates');
        $twig = new Environment($loader);
        $connection = new DatabaseConnection;
        $postModel  = new PostModel();

        $postModel->connection = $connection;
        $post = $postModel->getLastPost();
        echo $twig->render('home.html.twig', ['post' => $post]);
    }
}
