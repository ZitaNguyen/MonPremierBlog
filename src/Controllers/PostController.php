<?php

namespace App\Controllers;

use App\Controllers\AbstractController;
use App\Models\PostModel;
use App\Models\UserModel;
use App\Models\AdminModel;

class PostController extends AbstractController
{


    /**
     * Function to get all posts of blog.
     */
    public function getPosts()
    {
        $postModel  = new PostModel();
        $posts = $postModel->getPosts();
        $this->twig->display('posts.html.twig', ['posts' => $posts]);
    }
    // end getPosts


    /**
     * Function to get a single post with id.
    */
    public function getPost($id)
    {
        if (isset($_POST['submitAddCommentButton'])) {
            if (!empty($_POST['comment'])) {
                $userModel = new UserModel();
                $aData = [
                            'comment' => $_POST['comment'],
                            'person_id' => $_SESSION['user_id'],
                            'post_id' => $id,
                            'validate' => 0
                        ];

                $success = $userModel->addComment($aData);
                if (!$success) {
                    $_SESSION['message'] = 'Impossible d\'ajouter votre commentaire.';
                    $_SESSION['error_level'] = 'danger';
                }
                if ($_SESSION['user_role'] == 'admin') {
                    $adminModel = new AdminModel();
                    $adminModel->validateAdminComment($id);
                } else {
                    $_SESSION['message'] = 'Votre commentaire est en attente de validation.';
                    $_SESSION['error_level'] = 'info';
                }
                header("Location: /post-$id");
            } else {
                $_SESSION['message'] = 'Votre commentaire est vide.';
                $_SESSION['error_level'] = 'info';
                header("Location: /post-$id");
            }
        }

        $postModel  = new PostModel();
        $post = $postModel->getPost($id);
        $comments = $postModel->getComment($id);
        foreach ($comments as $comment)
            $comment->validate_date = date("d-m-Y", strtotime($comment->validate_date));
        $this->twig->display('post.html.twig', ['post' => $post, 'comments' => $comments]);
    }
    // end getPost


    /**
     * Function to get a single post with id in admin page
     */
    public function getAdminPost($id)
    {
        $postModel  = new PostModel();
        $post = $postModel->getPost($id);
        $comments = $postModel->getComment($id);
        foreach ($comments as $comment)
            $comment->validate_date = date("d-m-Y", strtotime($comment->validate_date));
        $this->twig->display('admin-view-post.html.twig', ['post' => $post, 'comments' => $comments]);
    }
    // end getAdminPost
}
