<?php
include 'vendor/autoload.php';

require_once('src/Controllers/HomeController.php');
require_once('src/Controllers/PostController.php');

use App\Controllers\HomeController\HomeController;
use App\Controllers\PostController\PostController;

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($uri) {
    case '/':
        (new HomeController())->displayHomePage();
        break;
    case '/blog':
        (new PostController())->getPosts();
        break;
    default:
        // TODO
        break;
}


