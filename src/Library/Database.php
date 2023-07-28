<?php

namespace App\Library;

use App\Library\Config;

class Database extends \PDO
{


	public function __construct()
	{
		parent::__construct('mysql:host=' . Config::DB_HOST . ';dbname=' . Config::DB_NAME . ';port=' . Config::DB_PORT . ';charset=' . Config::DB_CHARSET, Config::DB_USR, Config::DB_PW);
		$this->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
	}
}
