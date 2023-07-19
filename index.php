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
    case '/admin/posts':
        (new AdminController())->displayAdminPostsPage();
        break;
    case '/admin/add-post':
        (new AdminController())->addPost();
        break;
    case '/admin/users':
        (new AdminController())->viewUsers();
        break;
    default:
        preg_match('/[0-9]+/', $uri, $matches);
        $id = $matches[0];
        if(strpos($uri, 'modify-post') !== false)
            (new AdminController())->modifyPost($id);
        elseif(strpos($uri, 'delete-post') !== false)
            (new AdminController())->deletePost($id);
        elseif(strpos($uri, 'modify-user') !== false)
            (new AdminController())->modifyUser($id);
        elseif (strpos($uri, 'admin') !== false)
            (new PostController())->getAdminPost($id);
        else
            (new PostController())->getPost($id);
        break;
}


