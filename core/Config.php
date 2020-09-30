<?php 
	/**
	 * Contient les différentes configurations du projet
	 */
	class Config
	{
		public $dbConfig = [
			'sgbd' => 'mysql',
			'host' => 'localhost',
			'dbname' => 'fullbusi_bibliotheque',
			'user' => 'fullbusi_bibliotheque',
			'password' => '!!Deo1997!!'
		];

		public function dbConnexion()
		{
			try {
				$db = new PDO('mysql:host=' . $this->dbConfig['host'] .';dbname=' . $this->dbConfig['dbname'], 
					$this->dbConfig['user'], 
					$this->dbConfig['password'],
					[PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8']
				);
			} catch (PDOException $e) {
				die('Erreur de la connexion : ' . $e->getMessage());
			}

			return $db;
		}
	}




 ?>