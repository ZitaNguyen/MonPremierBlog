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
            "INSERT INTO Post (title, excerpt, content, author_id, category_id)
            VALUES (:title, :excerpt, :content, :author_id, :category_id)"
        );
        $sql->bindValue(':title', $aData['title'], \PDO::PARAM_STR);
        $sql->bindValue(':excerpt', $aData['excerpt'], \PDO::PARAM_STR);
        $sql->bindValue(':content', $aData['content'], \PDO::PARAM_LOB);
        $sql->bindValue(':author_id', $aData['author_id'], \PDO::PARAM_INT);
        $sql->bindValue(':category_id', $aData['category_id'], \PDO::PARAM_INT);
        return $sql->execute();
    }

    // public function postImg($tmp_name, $extension)
    // {
    //   $i = [
    //     'id'     => $this->oDb->lastInsertId(),
    //     'image'  => $this->oDb->lastInsertId().$extension
    //   ];

    //   $oStmt = $this->oDb->prepare('UPDATE Posts SET image = :image WHERE id = :id');
    //   move_uploaded_file($tmp_name,"static/img/posts/".$i['image']);
    //   return $oStmt->execute($i);
    // }
}