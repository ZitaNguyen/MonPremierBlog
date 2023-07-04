<?php

namespace App\Controllers;

use App\Controllers\AbstractController;
use App\Models\AdminModel;
use App\Models\PostModel;

class AdminController extends AbstractController
{
    public function displayAdminPage()
    {
        $postModel  = new PostModel();
        $posts = $postModel->getPosts();
        $this->twig->display('admin.html.twig', ['posts' => $posts]);
    }

    public function addPost()
    {
        $adminModel  = new AdminModel();

        if (isset($_POST['submitAddButton']))
        {
            if (!empty($_POST['title']) && !empty($_POST['excerpt']) && !empty($_POST['content']) && !empty($_POST['category']))
            {
                if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0)
                {
                    $file = $_FILES["image"];

                    // Specify the directory to which you want to save the uploaded image
                    $targetDir = "assets/img/";

                    // Check extension format
                    $extensions = ['.png','.jpg','.jpeg','.gif','.PNG','.JPG','.JPEG','.GIF'];
                    $extension = strrchr($file["name"], '.');
                    if (!in_array($extension,$extensions)) {
                        $_SESSION['message'] = 'Cette image n\'est pas valable.';
                        $_SESSION['error_level'] = 'warning';
                        header('Location: /add-post');
                    }

                    // Generate a unique name for the image to avoid conflicts
                    $fileName = uniqid() . "_" . $file["name"];

                    // Create the full path of the target file
                    $targetFilePath = $targetDir . $fileName;

                    // Move the uploaded file to the target location
                    if(!move_uploaded_file($file["tmp_name"], $targetFilePath)) {
                        $_SESSION['message'] = 'Impossible de télécharger la photo.';
                        $_SESSION['error_level'] = 'warning';
                        header('Location: /add-post');
                    }
                }

                $aData = [
                    'title' => $_POST['title'],
                    'excerpt' => $_POST['excerpt'],
                    'content' => $_POST['content'],
                    'person_id' => 1,
                    'category_id' => $_POST['category'],
                    'image' => $fileName
                ];

                $success = $adminModel->addPost($aData);
                if (!$success) {
                    $_SESSION['message'] = 'Impossible d\'ajouter votre article.';
                    $_SESSION['error_level'] = 'danger';
                    header('Location: /add-post');
                }
                else
                    header('Location: /blog');
            }
            else {
                $_SESSION['message'] = 'Tous les champs doivent être remplis.';
                $_SESSION['error_level'] = 'info';
                header('Location: /add-post');
            }
        }

        $categories = $adminModel->getCategories();
        $this->twig->display('add-post.html.twig', ['categories' => $categories]);
    }

    public function modifyPost($id)
    {
        $adminModel  = new AdminModel();
        $postModel  = new PostModel();

        if (isset($_POST['submitModifyButton']))
        {
            if (!empty($_POST['title']) && !empty($_POST['excerpt']) && !empty($_POST['content']) && !empty($_POST['category']))
            {
                if(isset($_FILES["image"]) && $_FILES["image"]["error"] == 0)
                {
                    $file = $_FILES["image"];

                    // Specify the directory to which you want to save the uploaded image
                    $targetDir = "assets/img/";

                    // Check extension format
                    $extensions = ['.png','.jpg','.jpeg','.gif','.PNG','.JPG','.JPEG','.GIF'];
                    $extension = strrchr($file["name"], '.');
                    if (!in_array($extension,$extensions)) {
                        $_SESSION['message'] = 'Cette photo n\'est pas valable.';
                        $_SESSION['error_level'] = 'warning';
                        header("Location: /modify-post-$id");
                    }

                    // Generate a unique name for the image to avoid conflicts
                    $fileName = uniqid() . "_" . $file["name"];

                    // Create the full path of the target file
                    $targetFilePath = $targetDir . $fileName;

                    // Move the uploaded file to the target location
                    if(!move_uploaded_file($file["tmp_name"], $targetFilePath)) {
                        $_SESSION['message'] = 'Impossible de télécharger la photo.';
                        $_SESSION['error_level'] = 'danger';
                        header("Location: /modify-post-$id");
                    }
                }
                else {
                    $_SESSION['message'] = 'Le champ photo est obligatoire.';
                    $_SESSION['error_level'] = 'danger';
                    header("Location: /modify-post-$id");
                }

                $aData = [
                    'id' => $id,
                    'title' => $_POST['title'],
                    'excerpt' => $_POST['excerpt'],
                    'content' => $_POST['content'],
                    'person_id' => 1,
                    'category_id' => $_POST['category'],
                    'image' => $fileName
                ];

                $success = $adminModel->modifyPost($aData);
                if (!$success) {
                    $_SESSION['message'] = 'Impossible de modifier votre article.';
                    $_SESSION['error_level'] = 'danger';
                    header("Location: /modify-post-$id");
                }
                else
                    header("Location: /post-$id");
            }
            else {
                $_SESSION['message'] = 'Tous les champs doivent être remplis.';
                $_SESSION['error_level'] = 'danger';
                header("Location: /modify-post-$id");
            }
        }

        $categories = $adminModel->getCategories();
        $post = $postModel->getPost($id);
        $this->twig->display('modify-post.html.twig', ['post' => $post, 'categories' => $categories]);
    }
}