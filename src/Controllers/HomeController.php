<?php

namespace App\Controllers;

use App\Controllers\AbstractController;
use App\Models\PostModel;

class HomeController extends AbstractController
{
    public function displayHomePage()
    {
        if (isset($_POST['submitContactFormButton']))
        {
            if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['message']))
            {
                $name = $_POST['name'];
                $email = $_POST['email'];
                $message = $_POST['message'];

                // Set up the email
                $to = 'zitanguyen84@gmail.com';
                $subject = "New Contact Form Submission";
                $body = "Name: " . $name . "\n";
                $body .= "Email: " . $email . "\n";
                $body .= "Message: " . $message;

                // Set headers
                $headers = "From: " . $email . "\r\n";
                $headers .= "Reply-To: " . $email . "\r\n";

                // Send the email
                if (mail($to, $subject, $body, $headers)) {
                    echo "Email sent successfully.";
                } else {
                    echo "Email sending failed.";
                }

            }
        }

        $postModel  = new PostModel;
        $post = $postModel->getLastPost();
        $this->twig->display('home.html.twig', ['post' => $post]);
    }
}
