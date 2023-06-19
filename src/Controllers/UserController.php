<?php

namespace App\Controllers;

use App\Controllers\AbstractController;
use App\Models\UserModel;

class UserController extends AbstractController
{

    public function register()
    {
        $userModel  = new UserModel();

        if (isset($_POST['submitRegisterButton']))
        {
            if (!empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['confirmation']))
            {
                // Check email account exists
                $user = $userModel->getUser($_POST['email']);
                if ($user) {
                    throw new \Exception('Email est déjà pris');
                    header('Location: /create-account');
                }

                // Check password confirmation
                if ($_POST['password'] != $_POST['confirmation'])
                {
                    throw new \Exception('La confirmation ne correspond pas à votre mot de passe');
                    header('Location: /create-account');
                }

                if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0)
                {
                    $file = $_FILES["image"];

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
                    'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                    'image' => $fileName ?? '',
                    'role_id' => 2
                ];

                $success = $userModel->register($aData);
                if (!$success)
                    throw new \Exception('Impossible de créer votre compte');
                else
                    header('Location: /login');
            }
            else
                throw new \Exception('Tous les champs doivent être remplis.');
        }

        $this->twig->display('register.html.twig');
    }

    public function login()
    {
        $userModel  = new UserModel();

        if (isset($_POST['submitLoginButton']))
        {
            if (!empty($_POST['email']) && !empty($_POST['password']))
            {
                // Get account by email
                $user = $userModel->getUser($_POST['email']);
                if (!$user) {
                    throw new \Exception('Email non existe');
                    // header('Location: /create-account');
                }

                // Check password
                $hash = $user['password'];
                if (!password_verify($_POST['password'], $hash))
                    throw new \Exception('Mot de passe incorrect');
                else {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['name'];
                    $_SESSION['role'] = $user['role'];
                    header('Location: /');
                }
            }
            else
                throw new \Exception('Tous les champs doivent être remplis.');
        }

        $this->twig->display('login.html.twig');
    }

    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);

        header("Location: /");
    }

}
