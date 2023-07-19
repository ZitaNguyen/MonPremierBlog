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
            "INSERT INTO Post (title, excerpt, content, person_id, category_id, image)
            VALUES (:title, :excerpt, :content, :person_id, :category_id, :image)"
        );
        $sql->bindValue(':title', $aData['title'], \PDO::PARAM_STR);
        $sql->bindValue(':excerpt', $aData['excerpt'], \PDO::PARAM_STR);
        $sql->bindValue(':content', $aData['content'], \PDO::PARAM_LOB);
        $sql->bindValue(':person_id', $aData['person_id'], \PDO::PARAM_INT);
        $sql->bindValue(':category_id', $aData['category_id'], \PDO::PARAM_INT);
        $sql->bindValue(':image', $aData['image'], \PDO::PARAM_STR);
        return $sql->execute();
    }

    public function modifyPost($aData)
    {
        $sql = $this->Db->prepare(
            "UPDATE Post
            SET title = :title, excerpt = :excerpt, content = :content, person_id = :person_id, category_id = :category_id, image = :image
            WHERE id = :id"
        );
        $sql->bindValue(':title', $aData['title'], \PDO::PARAM_STR);
        $sql->bindValue(':excerpt', $aData['excerpt'], \PDO::PARAM_STR);
        $sql->bindValue(':content', $aData['content'], \PDO::PARAM_LOB);
        $sql->bindValue(':person_id', $aData['person_id'], \PDO::PARAM_INT);
        $sql->bindValue(':category_id', $aData['category_id'], \PDO::PARAM_INT);
        $sql->bindValue(':image', $aData['image'], \PDO::PARAM_STR);
        $sql->bindValue(':id', $aData['id'], \PDO::PARAM_INT);
        return $sql->execute();
    }

    public function deletePost($id)
    {
        $sql = $this->Db->prepare(
            "DELETE FROM Post WHERE id = $id"
        );
        return $sql->execute();
    }

    public function getCategories()
    {
        $sql = $this->Db->prepare("SELECT c.id, c.name FROM Category c");
        $sql->execute();
        return $sql->fetchAll(\PDO::FETCH_OBJ);
    }

    public function modifyUser($id)
    {
        $sql = $this->Db->prepare(
            "UPDATE Person
            SET role_id = 1
            WHERE id = :id"
        );
        $sql->bindValue(':id', $id, \PDO::PARAM_INT);
        return $sql->execute();
    }
}