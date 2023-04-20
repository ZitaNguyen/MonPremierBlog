<?php

namespace App\Model\PostModel;

require_once('src/Library/Database.php');

use App\Library\Database\DatabaseConnection;

class Post
{
    public string $id;
    public string $title;
    public string $createDate;
    public string $content;
    public string $excerpt;
    public string $author;
}

class PostModel
{

    public DatabaseConnection $connection;

    public function getPosts(): array
    {
        $sql = $this->connection->getConnection()->query(
            "SELECT p.id, p.title, p.excerpt, DATE_FORMAT(p.create_date, '%d/%m/%Y') AS createDate, ps.name
            FROM Post p
            INNER JOIN Person ps
            WHERE p.author_id = ps.id
            ORDER BY create_date DESC"
        );

        $posts = [];
        while (($row = $sql->fetch())) {
            $post = new Post();
            $post->id = $row['id'];
            $post->title = $row['title'];
            $post->createDate = $row['createDate'];
            $post->excerpt = $row['excerpt'];
            $post->author = $row['name'];

            $posts[] = $post;
        }
        return $posts;
    }

    public function getPost($id)
    {
        $sql = $this->connection->getConnection()->query(
            "SELECT p.id, p.title, p.excerpt, p.content, DATE_FORMAT(p.create_date, '%d/%m/%Y') AS createDate, ps.name
            FROM Post p
            INNER JOIN Person ps
            WHERE p.author_id = ps.id
            AND p.id = $id
            ORDER BY create_date DESC"
        );
        $row = $sql->fetch();
        $post = new Post();
        $post->id = $row['id'];
        $post->title = $row['title'];
        $post->createDate = $row['createDate'];
        $post->content = $row['content'];
        $post->excerpt = $row['excerpt'];
        $post->author = $row['name'];
        return $post;
    }
}