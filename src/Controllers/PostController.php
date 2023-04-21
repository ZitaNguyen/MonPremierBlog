<?php

namespace App\Controllers\PostController;

require_once('src/Library/Database.php');
require_once('src/Models/PostModel.php');

use App\Library\Database\DatabaseConnection;
use App\Model\PostModel\PostModel;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class PostController
{
    public function getPosts()
    {
        $loader     = new FilesystemLoader('templates');
        $twig       = new Environment($loader);
        $connection = new DatabaseConnection;
        $postModel  = new PostModel();

        $postModel->connection = $connection;
        $posts = $postModel->getPosts();
        echo $twig->render('posts.html.twig', ['posts' => $posts]);
    }

    public function getPost($id)
    {
        $loader     = new FilesystemLoader('templates');
        $twig       = new Environment($loader);
        $connection = new DatabaseConnection;
        $postModel  = new PostModel();

        $postModel->connection = $connection;
        $post = $postModel->getPost($id);
        echo $twig->render('post.html.twig', ['post' => $post]);
    }

    public function addPost()
    {
        $loader     = new FilesystemLoader('templates');
        $twig       = new Environment($loader);
        // $connection = new DatabaseConnection;
        // $postModel  = new PostModel();

        // $postModel->connection = $connection;
        // $post = $postModel->addPost();
        echo $twig->render('add-post.html.twig');
    }
}