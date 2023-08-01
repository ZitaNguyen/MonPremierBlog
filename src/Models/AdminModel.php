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


    /**
     * Query to add a new post to the database.
     */
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


    /**
     * Query to update a post.
     */
    public function modifyPost($aData)
    {
        $sql = $this->Db->prepare(
            "UPDATE Post
            SET title = :title, excerpt = :excerpt, content = :content,
                person_id = :person_id, category_id = :category_id,
                image = :image, modify_date = NOW()
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


    /**
     * Query to delete a single post with id.
     */
    public function deletePost($id)
    {
        $sql = $this->Db->prepare(
            "DELETE FROM Post WHERE id = $id"
        );
        return $sql->execute();
    }


    /**
     * Query to get all categories of blog.
     */
    public function getCategories()
    {
        $sql = $this->Db->prepare("SELECT c.id, c.name FROM Category c");
        $sql->execute();
        return $sql->fetchAll(\PDO::FETCH_OBJ);
    }


    /**
     * Query to update user role.
     */
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


    /**
     * Query to delete a user.
     */
    public function deleteUser($id)
    {
        $sql = $this->Db->prepare(
            "DELETE FROM Person WHERE id = $id"
        );
        return $sql->execute();
    }


    /**
     * Query to validate a comment.
     */
    public function validateComment($id)
    {
        $sql = $this->Db->prepare(
            "UPDATE Comment
            SET validate = true, validate_date = NOW()
            WHERE id = :id"
        );
        $sql->bindValue(':id', $id, \PDO::PARAM_INT);
        return $sql->execute();
    }


    /**
     * Query to validate immediately a comment of an admin.
     */
    public function validateAdminComment($id)
    {
        $sql = $this->Db->prepare(
            "UPDATE Comment AS c1
            INNER JOIN (
                SELECT MAX(id) AS max_id
                FROM Comment
                WHERE post_id = :id
            ) AS c2 ON c1.id = c2.max_id
            SET c1.validate = true, c1.validate_date = NOW()
            WHERE c1.post_id = :id"
        );
        $sql->bindValue(':id', $id, \PDO::PARAM_INT);
        return $sql->execute();
    }
}
