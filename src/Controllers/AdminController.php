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
            if (!empty($_POST['title']) && !empty($_POST['excerpt']) && !empty($_POST['content']) && !empty($_POST['photo']))
            {
                $aData = [
                    'title' => $_POST['title'],
                    'excerpt' => $_POST['excerpt'],
                    'content' => $_POST['content'],
                    'photo' => $_POST['photo'],
                    // 'created_date' => date('Y-m-d H:i:s')
                ];
                $success = $adminModel->addPost($aData);
                if (!$success)
                    throw new \Exception('Impossible d\'ajouter un article');
                else
                    header('Location: index.php');

                // if (!empty($_FILES['image']['name']))
                // {
                // $file = $_FILES['image']['name'];
                // $extensions = ['.png','.jpg','.jpeg','.gif','.PNG','.JPG','.JPEG','.GIF'];
                // $extension = strrchr($file, '.');
                // if (!in_array($extension,$extensions))
                //     throw new \Exception ("Cette image n'est pas valable");

                // $this->oModel->postImg($_FILES['image']['tmp_name'], $extension);
                // }

                // $this->oUtil->sSuccMsg = 'L\'article a bien été ajouté !';
            }
            else
                throw new \Exception('Tous les champs doivent être remplis.');
        }

        $this->twig->display('add-post.html.twig');
    }
}