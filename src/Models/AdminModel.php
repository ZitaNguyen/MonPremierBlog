<?php

namespace App\Models;

use App\Library\Database;

class AdminModel
{

    protected $Db;

    public function __construct()
    {
        $this->Db = new Database();
    }

    public function addPost($aData)
    {
        $sql = $this->Db->prepare(
            "INSERT INTO Post (title, excerpt, content, author_id, category_id, photo)
            VALUES (:title, :excerpt, :content, :author_id, :category_id, :photo)"
        );
        $sql->bindValue(':title', $aData['title'], \PDO::PARAM_STR);
        $sql->bindValue(':excerpt', $aData['excerpt'], \PDO::PARAM_STR);
        $sql->bindValue(':content', $aData['content'], \PDO::PARAM_LOB);
        $sql->bindValue(':author_id', $aData['author_id'], \PDO::PARAM_INT);
        $sql->bindValue(':category_id', $aData['category_id'], \PDO::PARAM_INT);
        $sql->bindValue(':photo', $aData['photo'], \PDO::PARAM_STR);
        return $sql->execute();
    }

    public function modifyPost($aData)
    {
        $sql = $this->Db->prepare(
            "INSERT INTO Post (title, excerpt, content, author_id, category_id, photo)
            VALUES (:title, :excerpt, :content, :author_id, :category_id, :photo)"
        );
        $sql->bindValue(':title', $aData['title'], \PDO::PARAM_STR);
        $sql->bindValue(':excerpt', $aData['excerpt'], \PDO::PARAM_STR);
        $sql->bindValue(':content', $aData['content'], \PDO::PARAM_LOB);
        $sql->bindValue(':author_id', $aData['author_id'], \PDO::PARAM_INT);
        $sql->bindValue(':category_id', $aData['category_id'], \PDO::PARAM_INT);
        $sql->bindValue(':photo', $aData['photo'], \PDO::PARAM_STR);
        return $sql->execute();
    }

    public function getCategories()
    {
        $sql = $this->Db->prepare(
            "SELECT c.id, c.name
            FROM Category c"
        );
        $sql->execute();
        return $sql->fetchAll(\PDO::FETCH_OBJ);
    }
}