<?php

namespace App\Controllers;

use App\Controllers\AbstractController;
use App\Models\PostModel;
use App\Models\UserModel;

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
        if (isset($_POST['submitAddCommentButton']))
        {
            if (!empty($_POST['comment']))
            {
                $userModel = new UserModel();
                $aData = [
                    'comment' => $_POST['comment'],
                    'person_id' => $_SESSION['user_id'],
                    'post_id' => $id
                ];

                $success = $userModel->addComment($aData);
                if (!$success) {
                    $_SESSION['message'] = 'Impossible de postuler votre commentaire.';
                    $_SESSION['error_level'] = 'danger';
                }
                header("Location: /post-$id");
            }
            else {
                $_SESSION['message'] = 'Votre commentaire est vide.';
                $_SESSION['error_level'] = 'info';
                header("Location: /post-$id");
            }
        }

        $postModel  = new PostModel();
        $post = $postModel->getPost($id);
        $comments = $postModel->getComment($id);
        $this->twig->display('post.html.twig', ['post' => $post, 'comments' => $comments]);
    }
}