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


	/**
	 * Query to get all posts.
	 */
	public function getPosts(): array
	{
		$sql = $this->Db->prepare(
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
	*/
	public function getPost($id)
	{
		$sql = $this->Db->prepare(
			"SELECT p.id, p.title, p.excerpt, p.content, p.image, DATE_FORMAT(p.modify_date, '%d/%m/%Y') AS modifyDate, ps.name, c.id AS category_id, c.name AS category_name
			FROM Post p
			INNER JOIN Person ps ON p.person_id = ps.id
			INNER JOIN Category c ON p.category_id = c.id
			WHERE p.id = $id"
		);
		$sql->execute();
		return $sql->fetch();
	}


	/**
	 * Query to get the last post.
	 */
	public function getLastPost()
	{
		$sql = $this->Db->prepare(
			"SELECT p.id, p.title, p.excerpt, DATE_FORMAT(p.modify_date, '%d/%m/%Y') AS modifyDate, ps.name
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
	 */
	public function getComment($id): array
	{
		$sql = $this->Db->prepare(
			"SELECT c.comment, ps.name, ps.image, c.validate_date
			FROM Comment c
			INNER JOIN Post p ON p.id = c.post_id
			INNER JOIN Person ps ON ps.id = c.person_id
			WHERE c.post_id = $id AND c.validate = true
			ORDER BY c.validate_date DESC"
		);
		$sql->execute();
		return $sql->fetchAll(\PDO::FETCH_OBJ);
	}


	/**
	 * Query to get all comments for admin page.
	 */
	public function getComments()
	{
		$sql = $this->Db->prepare(
			"SELECT c.id, p.title, c.comment, c.validate
			FROM Comment c
			INNER JOIN Post p ON p.id = c.post_id
			ORDER BY c.id DESC"
		);
		$sql->execute();
		return $sql->fetchAll(\PDO::FETCH_OBJ);
	}
}
