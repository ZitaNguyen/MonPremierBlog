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
            if (!empty($_POST['title']) && !empty($_POST['excerpt']) && !empty($_POST['content']) && !empty($_POST['photo']) && !empty($_FILES['image']['name']))
            {
                $aData = [
                    'title' => $_POST['title'],
                    'excerpt' => $_POST['excerpt'],
                    'content' => $_POST['content'],
                    'author_id' => '',
                    'category_id' => ''
                    // 'created_date' => date('Y-m-d H:i:s')
                ];
                $success = $adminModel->addPost($aData);
                if (!$success)
                    throw new \Exception('Impossible d\'ajouter un article');
                else
                    header('Location: index.php');

                $file = $_FILES['photo']['name'];
                $extensions = ['.png','.jpg','.jpeg','.gif','.PNG','.JPG','.JPEG','.GIF'];
                $extension = strrchr($file, '.');
                if (!in_array($extension,$extensions))
                    throw new \Exception ("Cette image n'est pas valable");

                $adminModel->postImg($_FILES['photo']['tmp_name'], $extension);
            }
            else
                throw new \Exception('Tous les champs doivent être remplis.');
        }

        $this->twig->display('add-post.html.twig');
    }
}