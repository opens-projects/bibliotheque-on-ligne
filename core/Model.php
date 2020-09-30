<?php 
	/**
	 * Permet de faire des intéractions avec la database
	 */
	class Model
	{
		protected $contraintes = [];
		protected $table;
		protected $db;
		protected $primaryKey;

		public function __construct()
		{
			$config = new Config;
			$this->db = $config->dbConnexion();
		}

		public function search($query)
		{

			$sql = 'SELECT O.id_ouvrage, 
						   O.nbre_page,
						   O.titre,
						   O.contenu,
						   O.id_cat,
						   O.created,
						   O.resume,
						   C.libelle_cat AS categorie,
						   A.prenom,
						   A.nom
					FROM ouvrage AS O, categorie AS C, auteur AS A, ecrire AS E
					WHERE (titre LIKE :query OR prenom LIKE :query OR nom LIKE :query)
					  AND O.id_cat = C.id_cat
					  AND A.id_auteur = E.id_auteur
					  AND O.id_ouvrage = E.id_ouvrage';

			$req = $this->db->prepare($sql);
			$req->execute(['query' => '%'.$query.'%']);
			$data = $req->fetchAll(PDO::FETCH_OBJ);

			return $data;
		}

		public function add($donnees)
		{
			if (!is_array($donnees)) {
				throw new Exception('La variable $donnees dans la methode Model::add() doit être un tableau associatif');
			}else{
				$fields = $values = $q = [];
				foreach ($donnees as $key => $value) {
					$fields[] = $key;
					$values[":$key"] = $value;
				}

				for ($i=0; $i < count($fields); $i++) { 
					$q[] = str_replace($fields[$i], ':'.$fields[$i], $fields[$i]);
				}

				$str_fields = implode(',', $fields);
				$str_q		= implode(',', $q);

				$sql = 'INSERT INTO '.$this->table.'('.$str_fields.') VALUES('.$str_q.')';
				// debug($values);

				$req = $this->db->prepare($sql);
				$req->execute($values);

				return true;
			}
		}

		public function update($data)
		{
			$key = $this->primaryKey;
			$fields = $d = [];
			foreach ($data as $k => $v) {
				if ($k !== $this->primaryKey) {
					$fields[] = "$k=:$k";
				}
				
				$d[":$k"] = $v; 
			}

			$sql = 'UPDATE '.$this->table.' SET '.implode(',', $fields).' WHERE '.$key.'=:'.$key;

			// debug($sql);
			$req = $this->db->prepare($sql);
			$req->execute($d);

			return true;
		}

		public function find($contraintes = [])
		{
			$sql = 'SELECT ';

			$sql .= isset($contraintes['champs']) ? $contraintes['champs'].' ' : '* ';
			$sql .= 'FROM ' . $this->table .' ';
			$sql .= isset($contraintes['cond']) ? 'WHERE '.$contraintes['cond'] : '';
			$sql .= isset($contraintes['limit']) ? ' LIMIT '.$contraintes['limit'] : '';

			$req = $this->db->prepare($sql);
			$req->execute();
			
			if ($req) {
				return $req->fetchAll(PDO::FETCH_OBJ);
			}

			return false;

		}

		public function findOne($contraintes)
		{
			return $this->find($contraintes) 
				   ? current($this->find($contraintes)) 
				   : false;
		}

		public function count($contraintes = [])
		{
			return count($this->find($contraintes));
		}

		public function setTable($table)
		{
			$this->table = $table;
		}

		public function table()
		{
			return $this->table;
		}

		public function setPrimaryKey($key)
		{
			$this->primaryKey = $key;
		}

		public function primaryKey()
		{
			return $this->primaryKey;
		}
	}


 ?>