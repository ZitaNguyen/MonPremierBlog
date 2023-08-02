<?php

namespace App\Models;

use App\Library\Database;

class PostModel
{

    protected $Database;


    public function __construct()
    {
        $this->Database = new Database();

    }


    /**
     * Query to get all posts.
     * @return array of all blog posts
     */
    public function getPosts(): array
    {
        $sql = $this->Database->prepare(
            "SELECT p.id, p.title, p.excerpt, p.image, DATE_FORMAT(p.modify_date, '%d/%m/%Y') AS modifyDate, ps.name
            FROM Post p
            INNER JOIN Person ps ON p.person_id = ps.id
            ORDER BY create_date DESC"
        );
        $sql->execute();
        return $sql->fetchAll(\PDO::FETCH_OBJ);

    }


    /**
     * Query to get a single post with id.
     * @param integer $idPost
     * @return array of info of a post, author, category
    */
    public function getPost($idPost)
    {
        $sql = $this->Database->prepare(
            "SELECT p.id, p.title, p.excerpt, p.content, p.image,
                DATE_FORMAT(p.modify_date, '%d/%m/%Y') AS modifyDate,
                ps.name, c.id AS category_id, c.name AS category_name
            FROM Post p
            INNER JOIN Person ps ON p.person_id = ps.id
            INNER JOIN Category c ON p.category_id = c.id
            WHERE p.id = $idPost"
        );
        $sql->execute();
        return $sql->fetch();
    }


    /**
     * Query to get the last post.
     * @return boolean true if the query was successfully executed, false otherwise.
     */
    public function getLastPost()
    {
        $sql = $this->Database->prepare(
            "SELECT p.id, p.title, p.excerpt, DATE_FORMAT(p.modify_date, '%d/%m/%Y') AS modifyDate, ps.name, p.image
            FROM Post p
            INNER JOIN Person ps ON p.person_id = ps.id
            ORDER BY create_date DESC
            LIMIT 1"
        );
        $sql->execute();
        return $sql->fetch();
    }


    /**
     * Query to get comments of a certain post.
     * @param integer $idPost
     * @return array all comments of a post
     */
    public function getComment($idPost): array
    {
        $sql = $this->Database->prepare(
            "SELECT c.comment, ps.name, ps.image, r.role as role_name, c.validate_date
            FROM Comment c
            INNER JOIN Post p ON p.id = c.post_id
            INNER JOIN Person ps ON ps.id = c.person_id
            INNER JOIN Role r ON ps.role_id = r.id
            WHERE c.post_id = $idPost AND c.validate = true
            ORDER BY c.validate_date DESC"
        );
        $sql->execute();
        return $sql->fetchAll(\PDO::FETCH_OBJ);
    }


    /**
     * Query to get all comments for admin page.
     * @return array of all comments of all posts
     */
    public function getComments()
    {
        $sql = $this->Database->prepare(
            "SELECT c.id, p.title, c.comment, c.validate
            FROM Comment c
            INNER JOIN Post p ON p.id = c.post_id
            ORDER BY c.id DESC"
        );
        $sql->execute();
        return $sql->fetchAll(\PDO::FETCH_OBJ);
    }


}
