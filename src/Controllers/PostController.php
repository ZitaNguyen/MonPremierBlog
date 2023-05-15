<?php

namespace App\Controllers;

use App\Controllers\AbstractController;
use App\Models\PostModel;

class PostController extends AbstractController
{
    public function getPosts()
    {
        $postModel  = new PostModel();
        $posts = $postModel->getPosts();
        $this->twig->display('posts.html.twig', ['posts' => $posts]);
    }

    public function getPost($id)
    {
        $postModel  = new PostModel();
        $post = $postModel->getPost($id);
        $this->twig->display('post.html.twig', ['post' => $post]);
    }
}