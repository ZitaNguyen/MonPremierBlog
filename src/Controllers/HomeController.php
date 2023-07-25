<?php

namespace App\Controllers;

use App\Controllers\AbstractController;
use App\Models\PostModel;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class HomeController extends AbstractController
{
    public function displayHomePage()
    {
        if (isset($_POST['submitContactFormButton']))
        {
            if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['message']))
            {
                //Create an instance; passing `true` enables exceptions
                $mail = new PHPMailer(true);

                try {
                    //Server settings
                    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                    $mail->isSMTP();                                            //Send using SMTP
                    $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                    $mail->Username   = 'zitanguyen84@gmail.com';               //SMTP username
                    $mail->Password   = 'secret';                               //SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                    //Recipients
                    $mail->setFrom($mail->Username, 'Zita Nguyen');
                    $mail->addAddress($mail->Username);     //Add a recipient

                    //Content
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = 'Un email du blog Zita Nguyen';
                    $mail->Body    = "{$_POST['name']} du {$_POST['email']} écrit: {$_POST['message']}";

                    $mail->send();
                    $_SESSION['message'] = 'Votre message été envoyé';
                    $_SESSION['error_level'] = 'info';
                } catch (Exception $e) {
                    $_SESSION['message'] = "Impossible d'envoyer votre message. Erreur: {$mail->ErrorInfo}";
                    $_SESSION['error_level'] = 'warning';
                    header("Location: /");
                }
            }
        }

        $postModel  = new PostModel;
        $post = $postModel->getLastPost();
        $this->twig->display('home.html.twig', ['post' => $post]);
    }
}
