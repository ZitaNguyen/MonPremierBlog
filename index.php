<?php
session_start();

include 'vendor/autoload.php';

// use App\Controllers\AbstractController;
// use App\Controllers\HomeController;
// use App\Controllers\PostController;
// use App\Controllers\AdminController;
// use App\Controllers\UserController;
// use App\Controllers\ErrorController;

define('ROOT_PATH', __DIR__.'/src/');

// Parse the requested URL
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = trim($uri, '/');

// Define your routes here
$routes = array(
    ''                              => 'HomeController@displayHomePage',        // Home page
    'register'                      => 'UserController@register',               // Create an account
    'login'                         => 'UserController@login',                  // Connect
    'logout'                        => 'UserController@logout',                 // Disconnect
    'unset'                         => 'AbstractController@unsetSession',       // Unset message in session
    'blog'                          => 'PostController@getPosts',               // Show all blog posts
    'post-(\d+)'                    => 'PostController@getPost',                // Show a post
    'admin/posts'                   => 'AdminController@displayAdminPostsPage', // Admin page : Show all blog posts
    'admin/post-(\d+)'              => 'PostController@getAdminPost',           // Admin page: Show a post
    'admin/add-post'                => 'AdminController@addPost',               // Admin page : Add an blog post
    'admin/modify-post-(\d+)'       => 'AdminController@modifyPost',            // Admin page : Edit an blog post
    'admin/delete-post-(\d+)'       => 'AdminController@deletePost',            // Admin page : Delete an blog post
    'admin/users'                   => 'AdminController@viewUsers',             // Admin page : Show all users
    'admin/modify-user-(\d+)'       => 'AdminController@modifyUser',            // Admin page : Edit user role
    'admin/delete-user-(\d+)'       => 'AdminController@deleteUser',            // Admin page : Delete a user
    'admin/comments'                => 'AdminController@viewComments',          // Admin page : Show all comments
    'admin/validate-comment-(\d+)'  => 'AdminController@validateComment',       // Admin page : Validate a comment
);

// Find the matching route for the requested URL
$matchedRoute = null;
foreach ($routes as $route => $controller_action) {
    // Use preg_match to find a match with regular expression
    if (preg_match('#^' . $route . '$#', $uri, $matches)) {
        $matchedRoute = $controller_action;
        break;
    }
}

// If no route matches, handle 404 error
if ($matchedRoute === null) {
    // Show error page
    $matchedRoute = 'ErrorController@get404';
}

// Remove the first element, as it contains the full match, not just the captured parameters
array_shift($matches);

// Split the controller and action
list($controller, $action) = explode('@', $matchedRoute);

// Create the controller instance and call the corresponding action
$controllerNameSpace = "App\Controllers\\" . $controller;
$controllerInstance = new $controllerNameSpace();
call_user_func_array([$controllerInstance, $action], $matches);
