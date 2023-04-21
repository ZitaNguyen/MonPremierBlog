<?php

namespace App\Model\PostModel;

require_once('src/Library/Database.php');

use App\Library\Database\DatabaseConnection;

class PostModel
{

    public DatabaseConnection $connection;

    public function getPosts(): array
    {
        $sql = $this->connection->getConnection()->prepare(
            "SELECT p.id, p.title, p.excerpt, DATE_FORMAT(p.modify_date, '%d/%m/%Y') AS modifyDate, ps.name
            FROM Post p
            INNER JOIN Person ps
            WHERE p.author_id = ps.id
            ORDER BY create_date DESC
            LIMIT 5"
        );
        $sql->execute();
        return $sql->fetchAll(\PDO::FETCH_OBJ);
    }

    public function getPost($id)
    {
        $sql = $this->connection->getConnection()->prepare(
            "SELECT p.id, p.title, p.excerpt, p.content, DATE_FORMAT(p.modify_date, '%d/%m/%Y') AS modifyDate, ps.name
            FROM Post p
            INNER JOIN Person ps
            WHERE p.author_id = ps.id
            AND p.id = $id"
        );
        $sql->execute();
        return $sql->fetch();
    }

    public function getLastPost()
    {
        $sql = $this->connection->getConnection()->prepare(
            "SELECT p.id, p.title, p.excerpt, DATE_FORMAT(p.modify_date, '%d/%m/%Y') AS modifyDate, ps.name
            FROM Post p
            INNER JOIN Person ps
            WHERE p.author_id = ps.id
            ORDER BY create_date DESC
            LIMIT 1"
        );
        $sql->execute();
        return $sql->fetch();
    }

    public function addPost()
    {
        // $sql = $this->connection->getConnection()->prepare(
        //     "SELECT p.id, p.title, p.excerpt, DATE_FORMAT(p.modify_date, '%d/%m/%Y') AS modifyDate, ps.name
        //     FROM Post p
        //     INNER JOIN Person ps
        //     WHERE p.author_id = ps.id
        //     ORDER BY create_date DESC
        //     LIMIT 1"
        // );
        // $sql->execute();
        // return $sql->fetch();
    }
}