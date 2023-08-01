<?php

namespace App\Controllers;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class AbstractController
{

    protected $twig;


    /**
     * Construct method
     *
     * Load twig templates and store in a variable.
     * Add value of session to global.
     */
    public function __construct()
    {
        $loader = new FilesystemLoader('templates');
        $this->twig = new Environment($loader);
        $this->twig->addGlobal('session', $_SESSION);

    }


    /**
     * Function to set session value.
     * @param string $key
     * @param string $value
     * @return void
     */
    public function setSession($key, $value)
    {
        $_SESSION[$key] = $value;

    }


    /**
     * Function to get session value
     * @param string $key
     * @return string $_SESSION[$key] or null
     */
    public function getSession($key, $default = null)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : $default;

    }


    /**
     * Function to unset session value.
     * @param string $key
     * @return void
     */
    public function unsetSession($key)
    {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }

    }


    /**
     * Function to unset message in session.
     * @return void
     */
    public function unsetSessionMessage()
    {
        if (isset($_SESSION['message'])) {
            unset($_SESSION['message']);
        }
        if (isset($_SESSION['error_level'])) {
            unset($_SESSION['error_level']);
        }

    }


    /**
     * Function to get value from $_POST.
     * @param string $key
     * @return string $_POST[$key] or null
     */
    public function getPostValue($key, $default = null)
    {
        return isset($_POST[$key]) ? $_POST[$key] : $default;

    }


    /**
     * Function to handle uploaded file
     * @param string $name
     * @param string $redirectionPage
     * @return string $fileName
     */
    public function handleFileUpload($name, $redirectionPage)
    {
        $fileName = '';

        if (isset($_FILES[$name]) && isset($_FILES[$name]['error']) && $_FILES[$name]['error'] === UPLOAD_ERR_OK) {
            $file = $_FILES[$name];

            // Check extension format.
            $extensions = ['.png','.jpg','.jpeg','.gif','.PNG','.JPG','.JPEG','.GIF'];
            $extension = strrchr($file["name"], '.');
            if (!in_array($extension,$extensions)) {
                $this->setSession('message', 'Cette image n\'est pas valable.');
                $this->setSession('error_level', 'warning');
                exit(header("Location: $redirectionPage"));
            }

            // Specify the directory to which you want to save the uploaded image.
            $targetDir = "public/assets/img/";

            // Generate a unique name for the image to avoid conflicts.
            $fileName = uniqid()."_".$file["name"];

            // Create the full path of the target file.
            $targetFilePath = $targetDir.$fileName;

            // Move the uploaded file to the target location.
            if (!move_uploaded_file($file["tmp_name"], $targetFilePath)) {
                $this->setSession('message', 'Impossible de télécharger la photo.');
                $this->setSession('error_level', 'warning');
                exit(header("Location: $redirectionPage"));
            }
        }

        return $fileName;
        //end handleFileUpload
        
    }


}
