<?php

namespace Lib;

use PDO;

class DatabaseConnection
{
	public ?PDO $database = null;

	public function getConnection(): PDO
	{
		if ($this->database === null) {
			$this->database = new PDO('mysql:host=localhost;dbname=Challenge;charset=utf8', 'user', 'password');
		}

		return $this->database;
	}
}