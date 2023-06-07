<?php

namespace App\Models;

use App\Library\Database;

class PostModel
{
    protected $Db;

    public function __construct()
    {
        $this->Db = new Database();
    }

    public function getPosts(): array
    {
        $sql = $this->Db->prepare(
            "SELECT p.id, p.title, p.excerpt, DATE_FORMAT(p.modify_date, '%d/%m/%Y') AS modifyDate, ps.name
            FROM Post p
            INNER JOIN Person ps ON p.author_id = ps.id
            ORDER BY create_date DESC
            LIMIT 5"
        );
        $sql->execute();
        return $sql->fetchAll(\PDO::FETCH_OBJ);
    }

    public function getPost($id)
    {
        $sql = $this->Db->prepare(
            "SELECT p.id, p.title, p.excerpt, p.content, p.photo, DATE_FORMAT(p.modify_date, '%d/%m/%Y') AS modifyDate, ps.name, c.id AS category_id, c.name AS category_name
            FROM Post p
            INNER JOIN Person ps ON p.author_id = ps.id
            INNER JOIN Category c ON p.category_id = c.id
            WHERE p.id = $id"
        );
        $sql->execute();
        return $sql->fetch();
    }

    public function getLastPost()
    {
        $sql = $this->Db->prepare(
            "SELECT p.id, p.title, p.excerpt, DATE_FORMAT(p.modify_date, '%d/%m/%Y') AS modifyDate, ps.name
            FROM Post p
            INNER JOIN Person ps ON p.author_id = ps.id
            ORDER BY create_date DESC
            LIMIT 1"
        );
        $sql->execute();
        return $sql->fetch();
    }
}