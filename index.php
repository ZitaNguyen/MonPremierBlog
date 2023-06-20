<?php
session_start();

include 'vendor/autoload.php';

use App\Controllers\AbstractController;
use App\Controllers\HomeController;
use App\Controllers\PostController;
use App\Controllers\AdminController;
use App\Controllers\UserController;

define('ROOT_PATH', __DIR__ . '/src/');

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($uri) {
    case '/':
        (new HomeController())->displayHomePage();
        break;
    case '/blog':
        (new PostController())->getPosts();
        break;
    case '/add-post':
        (new AdminController())->addPost();
        break;
    case '/login':
        (new UserController())->login();
        break;
    case '/register':
        (new UserController())->register();
        break;
    case '/logout':
        (new UserController())->logout();
        break;
    case '/unset':
        (new AbstractController())->unsetSession();
        break;
    default:
        preg_match('/[0-9]+/', $uri, $matches);
        $id = $matches[0];
        if(strpos($uri, 'modify-post') !== false)
            (new AdminController())->modifyPost($id);
        else
            (new PostController())->getPost($id);
        break;
}


