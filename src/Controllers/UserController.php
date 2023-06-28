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
                    $_SESSION['message'] = 'Email est déjà enregistré.';
                    $_SESSION['error_level'] = 'info';
                    header('Location: /login');
                }

                // Check password confirmation
                if ($_POST['password'] != $_POST['confirmation'])
                {
                    $_SESSION['message'] = 'La confirmation ne correspond pas à votre mot de passe.';
                    $_SESSION['error_level'] = 'warning';
                    header('Location: /register');
                }

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
                        header('Location: /register');
                    }

                    // Generate a unique name for the image to avoid conflicts
                    $fileName = uniqid() . "_" . $file["name"];

                    // Create the full path of the target file
                    $targetFilePath = $targetDir . $fileName;

                    // Move the uploaded file to the target location
                    if(!move_uploaded_file($file["tmp_name"], $targetFilePath)) {
                        $_SESSION['message'] = 'Impossible de télécharger la photo.';
                        $_SESSION['error_level'] = 'danger';
                        header('Location: /register');
                    }
                }

                $aData = [
                    'name' => $_POST['username'],
                    'email' => $_POST['email'],
                    'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                    'image' => $fileName ?? '',
                    'role_id' => 2
                ];

                $success = $userModel->register($aData);
                if (!$success) {
                    $_SESSION['message'] = 'Impossible de créer votre compte.';
                    $_SESSION['error_level'] = 'danger';
                    header('Location: /register');
                }
                else {
                    $_SESSION['message'] = 'Vous avez réussi à créer votre compte. Veuillez connecter.';
                    $_SESSION['error_level'] = 'success';
                    header('Location: /login');
                }
            }
            else {
                $_SESSION['message'] = 'Tous les champs doivent être remplis.';
                $_SESSION['error_level'] = 'danger';
                header('Location: /register');
            }
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
                    $_SESSION['message'] = 'Email non existe. Veuillez créer votre compte.';
                    $_SESSION['error_level'] = 'danger';
                    header('Location: /register');
                }

                // Check password
                $hash = $user['password'];
                if (!password_verify($_POST['password'], $hash)) {
                    $_SESSION['message'] = 'Mot de passe incorrect';
                    $_SESSION['error_level'] = 'danger';
                }
                else {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['name'];
                    $_SESSION['role'] = $user['role'];
                    header('Location: /');
                }
            }
            else {
                $_SESSION['message'] = 'Tous les champs doivent être remplis.';
                $_SESSION['error_level'] = 'warning';
            }
        }

        $this->twig->display('login.html.twig');
    }

    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
        unset($_SESSION['role']);

        header("Location: /");
    }

}
