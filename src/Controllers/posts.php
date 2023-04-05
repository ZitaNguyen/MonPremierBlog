<?php

require(__DIR__ . '/models/model.php');

$posts = getPosts();

require(__DIR__ . '/templates/posts.php');