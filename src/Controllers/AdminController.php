<?php

namespace App\Controllers;

use App\Controllers\AbstractController;
use App\Models\AdminModel;

class AdminController extends AbstractController
{
    public function addPost()
    {
        $adminModel  = new AdminModel();

        if (isset($_POST['submitAddButton']))
        {
            if (!empty($_POST['title']) && !empty($_POST['excerpt']) && !empty($_POST['content']) && !empty($_POST['category']))
            {
                if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0) {
                    $file = $_FILES["photo"];

                    // Specify the directory to which you want to save the uploaded image
                    $targetDir = "assets/img/";

                    // Check extension format
                    $extensions = ['.png','.jpg','.jpeg','.gif','.PNG','.JPG','.JPEG','.GIF'];
                    $extension = strrchr($file["name"], '.');
                    if (!in_array($extension,$extensions))
                        throw new \Exception ("Cette image n'est pas valable");

                    // Generate a unique name for the image to avoid conflicts
                    $fileName = uniqid() . "_" . $file["name"];

                    // Create the full path of the target file
                    $targetFilePath = $targetDir . $fileName;

                    // Move the uploaded file to the target location
                    if(!move_uploaded_file($file["tmp_name"], $targetFilePath))
                        throw new \Exception('Impossible de télécharger la photo');
                }

                $aData = [
                    'title' => $_POST['title'],
                    'excerpt' => $_POST['excerpt'],
                    'content' => $_POST['content'],
                    'author_id' => '1',
                    'category_id' => $_POST['category'],
                    'photo' => $fileName
                ];

                $success = $adminModel->addPost($aData);
                if (!$success)
                    throw new \Exception('Impossible d\'ajouter un article');
                else
                    header('Location: blog');
            }
            else
                throw new \Exception('Tous les champs doivent être remplis.');
        }

        $categories = $adminModel->getCategories();
        $this->twig->display('add-post.html.twig', ['categories' => $categories]);
    }
}