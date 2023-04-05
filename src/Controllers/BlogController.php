<?php

require(__DIR__ . '/Models/post.php');

$posts = getPosts();

require(__DIR__ . '/../templates/blog.html');