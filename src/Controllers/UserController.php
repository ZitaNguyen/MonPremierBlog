<?php

namespace App\Controllers;

use App\Controllers\AbstractController;
use App\Models\UserModel;

class UserController extends AbstractController
{


    /**
     * Function for a new user to register.
     * @return void
    */
    public function register()
    {
        $userModel  = new UserModel();

        if (isset($_POST['submitRegisterButton'])) {
            // Get value from $_POST.
            $email = $this->getPostValue('email');
            $username = $this->getPostValue('username');
            $password = $this->getPostValue('password');
            $confirmation = $this->getPostValue('confirmation');

            if (!empty($email) && !empty($username) && !empty($password) && !empty($confirmation)) {
                // Check if email account exists.
                $user = $userModel->getUser($email);
                if (isset($user['id'])) {
                    $this->setSession('message', 'Email est déjà enregistré.');
                    $this->setSession('error_level', 'info');
                    exit(header('Location: /register'));
                }

                // Check if confirmation matches.
                if ($password !== $confirmation) {
                    $this->setSession('message', 'La confirmation ne correspond pas à votre mot de passe.');
                    $this->setSession('error_level', 'warning');
                    exit(header('Location: /register'));
                }

                // Handle upload file.
                $fileInputName = "image";
                $redirectionPage = "/register";
                $fileName = $this->handleFileUpload($fileInputName, $redirectionPage);

                // Prepare data to add into database
                $aData = [
                    'name'      => $username,
                    'email'     => $email,
                    'password'  => password_hash($password, PASSWORD_DEFAULT),
                    'image'     => $fileName,
                    'role_id'   => 2
                ];

                // Add new user into database.
                $success = $userModel->register($aData);
                if (!$success) {
                    $this->setSession('message', 'Impossible de créer votre compte.');
                    $this->setSession('error_level', 'danger');
                    exit(header('Location: /register'));
                } else {
                    $this->setSession('message', 'Vous avez réussi à créer votre compte. Veuillez connecter.');
                    $this->setSession('error_level', 'success');
                    exit(header('Location: /login'));
                }

            }
            // When form is not filled in correctly.
            $this->setSession('message', 'Tous les champs doivent être remplis.');
            $this->setSession('error_level', 'danger');
            exit(header('Location: /register'));

        } // end if (isset($_POST['submitRegisterButton']))

        $this->twig->display('register.html.twig');
        // end register

    }


    /**
     * Function for a user to login.
     * @return void
     */
    public function login()
    {
        $userModel  = new UserModel();

        if (isset($_POST['submitLoginButton'])) {
            // Get value from $_POST
            $email = $this->getPostValue('email');
            $password = $this->getPostValue('password');
            if (!empty($email) && !empty($password)) {
                // Check if account exits.
                $user = $userModel->getUser($email);
                if ($user === false) {
                    $this->setSession('message', 'Email non existe. Veuillez créer votre compte.');
                    $this->setSession('error_level', 'danger');
                    exit(header('Location: /register'));
                }
                // Check if password is correct.
                if (!password_verify($_POST['password'], $user['password'])) {
                    $this->setSession('message', 'Mot de passe incorrect.');
                    $this->setSession('error_level', 'danger');
                    exit(header('Location: /login'));
                }

                // Set session value after login.
                $this->setSession('user_id', $user['id']);
                $this->setSession('username', $user['name']);
                $this->setSession('user_role', $user['role']);
                exit(header('Location: /'));

            }
            // When form is not filled in correctly.
            $this->setSession('message', 'Tous les champs doivent être remplis.');
            $this->setSession('error_level', 'warning');
            exit(header('Location: /login'));
            
        } // end if (isset($_POST['submitLoginButton']))

        $this->twig->display('login.html.twig');
        // end login

    }


    /**
     * Function for a user to logout
     * @return void
     */
    public function logout()
    {
        $this->unsetSession('user_id');
        $this->unsetSession('username');
        $this->unsetSession('user_role');
        exit(header("Location: /"));
        // end logout

    }

}
