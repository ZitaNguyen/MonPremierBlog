<?php

namespace App\Models;

use App\Library\Database;

class AdminModel
{

    protected $Database;


    public function __construct()
    {
        $this->Database = new Database();
    }


    /**
     * Query to add a new post to the database.
     * @param array $aData
     * @return boolean True if the query was successfully executed, false otherwise.
     */
    public function addPost($aData)
    {
        $sql = $this->Database->prepare(
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
     * @param array $aData
     * @return boolean True if the query was successfully executed, false otherwise.
     */
    public function modifyPost($aData)
    {
        $sql = $this->Database->prepare(
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
     * @param integer $idPost
     * @return boolean True if the query was successfully executed, false otherwise.
     */
    public function deletePost($idPost)
    {
        $sql = $this->Database->prepare("DELETE FROM Post WHERE id = $idPost");
        return $sql->execute();
    }


    /**
     * Query to get all categories of blog.
     * @return array
     */
    public function getCategories()
    {
        $sql = $this->Database->prepare("SELECT c.id, c.name FROM Category c");
        $sql->execute();
        return $sql->fetchAll(\PDO::FETCH_OBJ);
    }


    /**
     * Query to update user role.
     * @param integer $idUser
     */
    public function modifyUser($idUser)
    {
        $sql = $this->Database->prepare(
            "UPDATE Person
            SET role_id = 1
            WHERE id = :id"
        );
        $sql->bindValue(':id', $idUser, \PDO::PARAM_INT);
        return $sql->execute();
    }


    /**
     * Query to delete a user.
     * @param integer $idUser
     * @return boolean True if the query was successfully executed, false otherwise.
     */
    public function deleteUser($idUser)
    {
        $sql = $this->Database->prepare("DELETE FROM Person WHERE id = $idUser");
        return $sql->execute();
    }


    /**
     * Query to validate a comment.
     * @param integer $idComment
     * @return boolean True if the query was successfully executed, false otherwise.
     */
    public function validateComment($idComment)
    {
        $sql = $this->Database->prepare(
            "UPDATE Comment
            SET validate = true, validate_date = NOW()
            WHERE id = :id"
        );
        $sql->bindValue(':id', $idComment, \PDO::PARAM_INT);
        return $sql->execute();
    }


    /**
     * Query to validate immediately a comment of an admin.
     * @param integer $idPost
     * @return boolean true if the query was successfully executed, false otherwise.
     */
    public function validateAdminComment($idPost)
    {
        $sql = $this->Database->prepare(
            "UPDATE Comment AS c1
            INNER JOIN (
                SELECT MAX(id) AS max_id
                FROM Comment
                WHERE post_id = :id
            ) AS c2 ON c1.id = c2.max_id
            SET c1.validate = true, c1.validate_date = NOW()
            WHERE c1.post_id = :id"
        );
        $sql->bindValue(':id', $idPost, \PDO::PARAM_INT);
        return $sql->execute();
    }


}
