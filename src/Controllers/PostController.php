<?php

namespace App\Controllers;

use App\Models\PostModel;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class PostController
{
    public function getPosts()
    {
        $loader     = new FilesystemLoader('templates');
        $twig       = new Environment($loader);
        $postModel  = new PostModel();

        $posts = $postModel->getPosts();
        echo $twig->render('posts.html.twig', ['posts' => $posts]);
    }

    public function getPost($id)
    {
        $loader     = new FilesystemLoader('templates');
        $twig       = new Environment($loader);
        $postModel  = new PostModel();

        $post = $postModel->getPost($id);
        echo $twig->render('post.html.twig', ['post' => $post]);
    }
}