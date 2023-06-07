<?php

namespace App\Controllers;

use App\Controllers\AbstractController;
use App\Models\UserModel;

class UserController extends AbstractController
{

    public function createAccount()
    {
        $userModel  = new UserModel();

        if (isset($_POST['submitCreateButton']))
        {
            if (!empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['confirmation']))
            {
                // Check email account exists
                $emailExist = $userModel->checkEmail($_POST['email']);
                if ($emailExist) {
                    throw new \Exception('Email est déjà pris');
                    // header('Location: /create-account');
                }

                // Check password confirmation
                if ($_POST['password'] != $_POST['confirmation'])
                {
                    throw new \Exception('La confirmation ne correspond pas à votre mot de passe');
                    header('Location: /create-account');
                }

                if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0)
                {
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
                    'name' => $_POST['username'],
                    'email' => $_POST['email'],
                    'password' => $_POST['password'],
                    'photo' => $fileName ?? '',
                    'role_id' => 2
                ];

                $success = $userModel->createAccount($aData);
                if (!$success)
                    throw new \Exception('Impossible de créer votre compte');
                else
                    header('Location: /');
            }
            else
                throw new \Exception('Tous les champs doivent être remplis.');
        }

        $this->twig->display('create-account.html.twig');
    }

    public function login()
    {
        $userModel  = new UserModel();

        if (isset($_POST['submitLoginButton']))
        {
            if (!empty($_POST['username']) && !empty($_POST['password']))
            {
                $aData = [
                    'username' => $_POST['username'],
                    'password' => $_POST['password']
                ];

                $success = $userModel->login($aData);
                if (!$success)
                    throw new \Exception('Impossible d\'accéder à votre compte');
                else
                    header('Location: /');
            }
            else
                throw new \Exception('Tous les champs doivent être remplis.');
        }

        $this->twig->display('login.html.twig');
    }

    public function logout()
    {
        // Handle logout logic here
        // Destroy session variables and redirect to the login page

        header("Location: /");
    }

}
