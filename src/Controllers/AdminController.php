<?php

namespace App\Controllers;

use App\Controllers\AbstractController;
use App\Models\AdminModel;
use App\Models\PostModel;
use App\Models\UserModel;

class AdminController extends AbstractController
{

    /**
     * Function to show all posts at admin page.
     * @return void
     */
    public function displayAdminPostsPage()
    {
        $postModel  = new PostModel();
        $posts = $postModel->getPosts();
        $this->twig->display('admin-posts.html.twig', ['posts' => $posts]);
    } // end displayAdminPostsPage


    /**
     * Function for admin to add new post.
     * @return void
     */
    public function addPost()
    {
        $adminModel  = new AdminModel();

        if (isset($_POST['submitAddButton'])) {
            // Get value from $_POST.
            $title = $this->getPostValue('title');
            $excerpt = $this->getPostValue('excerpt');
            $content = $this->getPostValue('content');
            $category = $this->getPostValue('category');

            if (!empty($title) && !empty($excerpt) && !empty($content) && !empty($category)) {
                // Handle upload file.
                $fileInputName = "image";
                $redirectionPage = '/admin/add-post';
                $fileName = $this->handleFileUpload($fileInputName, $redirectionPage);

                // Prepare data to add into database.
                $aData = [
                            'title'         => $title,
                            'excerpt'       => $excerpt,
                            'content'       => $content,
                            'person_id'     => 1,
                            'category_id'   => $category,
                            'image'         => $fileName
                        ];

                // Add post into database.
                $success = $adminModel->addPost($aData);
                if (!$success) {
                    $this->setSession('message', 'Impossible d\'ajouter votre article.');
                    $this->setSession('error_level', 'danger');
                    exit(header('Location: /admin/add-post'));
                } else {
                    exit(header('Location: /admin/posts'));
                }

            } else { // When form is not filled in correctly.
                $this->setSession('message', 'Tous les champs doivent être remplis.');
                $this->setSession('error_level', 'info');
                exit(header('Location: /admin/add-post'));
            }
        } // end if (isset($_POST['submitAddButton']))

        $categories = $adminModel->getCategories();
        $this->twig->display('admin-add-post.html.twig', ['categories' => $categories]);
    } // end addPost


    /**
     * Function for admin to modify a post.
     * @return void
     */
    public function modifyPost($id)
    {
        $adminModel  = new AdminModel();
        $postModel  = new PostModel();

        if (isset($_POST['submitModifyButton'])) {
            // Get value from $_POST.
            $title = $this->getPostValue('title');
            $excerpt = $this->getPostValue('excerpt');
            $content = $this->getPostValue('content');
            $category = $this->getPostValue('category');

            if (!empty($title) && !empty($excerpt) && !empty($content) && !empty($category)) {
                 // Handle upload file.
                 $fileInputName = "image";
                 $redirectionPage = "/admin/modify-post-$id";
                 $fileName = $this->handleFileUpload($fileInputName, $redirectionPage);

                // Preapare data to add into database.
                $aData = [
                            'id'            => $id,
                            'title'         => $title,
                            'excerpt'       => $excerpt,
                            'content'       => $content,
                            'person_id'     => 1,
                            'category_id'   => $category,
                            'image'         => $fileName
                        ];

                // Add modified post into database.
                $success = $adminModel->modifyPost($aData);
                if (!$success) {
                    $this->setSession('message', 'Impossible de modifier votre article.');
                    $this->setSession('error_level', 'danger');
                    exit(header("Location: /admin/modify-post-$id"));
                } else {
                    exit(header("Location: /admin/post-$id"));
                }

            } else { // When form is not filled in correctly.
                $this->setSession('message', 'Tous les champs doivent être remplis.');
                $this->setSession('error_level', 'danger');
                exit(header("Location: /admin/modify-post-$id"));
            }
        } // end if (isset($_POST['submitModifyButton']))

        $categories = $adminModel->getCategories();
        $post = $postModel->getPost($id);
        $this->twig->display('admin-modify-post.html.twig', ['post' => $post, 'categories' => $categories]);
    } // end modifyPost


    /**
     * Function for admin to delete a post.
     * @return void
     */
    public function deletePost($id)
    {
        $adminModel = new AdminModel();
        $adminModel->deletePost($id);
        $this->setSession('message', 'L\'article est supprimé.');
        $this->setSession('error_level', 'info');
        header("Location: /admin/posts");
    } // end deletePost


    /**
     * Function to show all users.
     * @return void
     */
    public function viewUsers()
    {
        $userModel = new UserModel();
        $users = $userModel->getUsers();
        $this->twig->display('admin-users.html.twig', ['users' => $users]);
    } // end viewUsers


    /**
     * Function for admin to modify a user role.
     * @return void
     */
    public function modifyUser($id)
    {
        $adminModel = new AdminModel();
        $adminModel->modifyUser($id);
        exit(header("Location: /admin/users"));
    } // end modifyUser


    /**
     * Function for admin to delete a user.
     * @return void
     */
    public function deleteUser($id)
    {
        $adminModel = new AdminModel();
        $adminModel->deleteUser($id);
        $this->setSession('message', 'L\'utilisateur est supprimé.');
        $this->setSession('error_level', 'info');
        exit(header("Location: /admin/users"));
    } // end deleteUser


    /**
     * Function for admin to see all comments.
     * @return void
     */
    public function viewComments()
    {
        $postModel = new PostModel();
        $comments = $postModel->getComments();
        $this->twig->display('admin-comments.html.twig', ['comments' => $comments]);
    } // end viewComments


    /**
     * Function for admin to validate a comment.
     * @return void
     */
    public function validateComment($id)
    {
        $adminModel = new AdminModel();
        $adminModel->validateComment($id);
        exit(header("Location: /admin/comments"));
    } // end validateComment

    /**
     * Function to validate immediately a comment from an admin.
     * @return void
     */
    public function validateAdminComment($id)
    {
        $adminModel = new AdminModel();
        $adminModel->validateAdminComment($id);
        exit(header("Location: /post-$id"));
    } // end validateAdminComment
}
