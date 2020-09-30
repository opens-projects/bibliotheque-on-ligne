<?php 
	/**
	 * ConnexionModel
	 */
	class ConnexionModel extends Model
	{
		public function findLecteur($req)
		{
			$this->table = 'lecteur';
			return $this->findOne($req);
		}

		public function isSouscribe($req)
		{
			$this->table = 'souscrire';
			
		}

		public function isAlreadyUsed($table, $req)
		{
			$this->table = $table;
			return $this->findOne($req);
		}
	}

 ?>