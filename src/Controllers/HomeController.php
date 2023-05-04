<?php

namespace App\Controllers;

use App\Controllers\AbstractController;
use App\Models\PostModel;

class HomeController extends AbstractController
{
    public function displayHomePage()
    {
        $postModel  = new PostModel;
        $post = $postModel->getLastPost();
        $this->twig->display('home.html.twig', ['post' => $post]);
    }
}
