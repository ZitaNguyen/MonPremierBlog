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
     * @return void
     */
    public function getPosts()
    {
        $postModel  = new PostModel();
        $posts = $postModel->getPosts();
        $this->twig->display('posts.html.twig', ['posts' => $posts]);
    } // end getPosts


    /**
     * Function to get a single post with id.
     * @return void
    */
    public function getPost($id)
    {
        if (isset($_POST['submitAddCommentButton'])) {
            // Get value from $_POST
            $comment = $this->getPostValue('comment');

            if (!empty($comment)) {
                $userModel = new UserModel();

                // Prepare data to add into database.
                $aData = [
                            'comment' => $comment,
                            'person_id' => $this->getSession('user_id'),
                            'post_id' => $id,
                            'validate' => 0
                        ];

                // Add new comment into database.
                $success = $userModel->addComment($aData);
                if (!$success) {
                    $this->setSession('message', 'Impossible d\'ajouter votre commentaire.');
                    $this->setSession('error_level', 'danger');
                }

                // if comment is posted by admin, show comment immediately.
                if ($this->getSession('user_role') == 'admin') {
                    $adminModel = new AdminModel();
                    $adminModel->validateAdminComment($id);
                } else {
                    $this->setSession('message', 'Votre commentaire est en attente de validation.');
                    $this->setSession('error_level', 'info');
                }

                exit(header("Location: /post-$id"));

            } else { // When no message in comment form.
                $this->setSession('message', 'Votre commentaire est vide.');
                $this->setSession('error_level', 'info');
                exit(header("Location: /post-$id"));
            }
        } // end if (isset($_POST['submitAddCommentButton']))

        $postModel  = new PostModel();
        $post = $postModel->getPost($id);
        $comments = $postModel->getComment($id);
        foreach ($comments as $comment)
            $comment->validate_date = date("d-m-Y", strtotime($comment->validate_date));
        $this->twig->display('post.html.twig', ['post' => $post, 'comments' => $comments]);
    } // end getPost


    /**
     * Function to get a single post with id in admin page
     * @return void
     */
    public function getAdminPost($id)
    {
        $postModel  = new PostModel();
        $post = $postModel->getPost($id);
        $comments = $postModel->getComment($id);
        foreach ($comments as $comment)
            $comment->validate_date = date("d-m-Y", strtotime($comment->validate_date));
        $this->twig->display('admin-view-post.html.twig', ['post' => $post, 'comments' => $comments]);
    } // end getAdminPost

}
