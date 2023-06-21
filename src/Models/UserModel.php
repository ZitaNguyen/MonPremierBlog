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

    public function register($aData)
    {
        $sql = $this->Db->prepare(
            "INSERT INTO Person (name, email, password, image, role_id)
            VALUES (:name, :email, :password, :image, :role_id)"
        );
        $sql->bindValue(':name', $aData['name'], \PDO::PARAM_STR);
        $sql->bindValue(':email', $aData['email'], \PDO::PARAM_STR);
        $sql->bindValue(':password', $aData['password'], \PDO::PARAM_STR);
        $sql->bindValue(':image', $aData['image'], \PDO::PARAM_STR);
        $sql->bindValue(':role_id', $aData['role_id'], \PDO::PARAM_INT);
        return $sql->execute();
    }

    public function getUser($email)
    {
        $sql = $this->Db->prepare(
            "SELECT p.*, r.role FROM Person p
            INNER JOIN Role r ON p.role_id = r.id
            WHERE email = :email");
        $sql->bindParam(':email', $email);
        $sql->execute();
        return $sql->fetch();
    }
}