<?php
include 'vendor/autoload.php';

use App\Library;
use App\Controllers\HomeController;
use App\Controllers\PostController;
use App\Controllers\AdminController;

define('ROOT_PATH', __DIR__ . '/src/');

require ROOT_PATH . 'Library/Loader.php';

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
    default:
        preg_match('/[0-9]+/', $uri, $matches);
        $id = $matches[0];
        (new PostController())->getPost($id);
        break;
}


