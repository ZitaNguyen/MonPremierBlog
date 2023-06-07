<?php

namespace App\Models;

use App\Library\Database;

class UserModel
{

    protected $Db;

    public function __construct()
    {
        $this->Db = new Database();
    }

    public function login($aData)
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

    public function createAccount($aData)
    {
        $sql = $this->Db->prepare(
            "INSERT INTO Person (name, email, password, photo, role_id)
            VALUES (:name, :email, :password, :photo, :role_id)"
        );
        $sql->bindValue(':name', $aData['name'], \PDO::PARAM_STR);
        $sql->bindValue(':email', $aData['email'], \PDO::PARAM_STR);
        $sql->bindValue(':password', $aData['password'], \PDO::PARAM_STR);
        $sql->bindValue(':photo', $aData['photo'], \PDO::PARAM_STR);
        $sql->bindValue(':role_id', $aData['role_id'], \PDO::PARAM_INT);
        return $sql->execute();
    }

    public function checkEmail($email)
    {
        $sql = $this->Db->prepare("SELECT * FROM Person WHERE email = :email");
        $sql->bindParam(':email', $email);
        $sql->execute();
        return $sql->fetch();
    }
}