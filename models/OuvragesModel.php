<?php 
	/**
	 * Les requêtes ayant liées aux ouvrages
	 */
	class OuvragesModel extends Model
	{
		public function findAuteur($idOuvrage)
		{
			$this->setTable('ecrire');

			$idAuteur = $this->findOne([
				'champs' => 'id_auteur',
				'cond' => 'id_ouvrage = '.$idOuvrage
			])->id_auteur;

			// debug($idAuteur);

			$this->setTable('auteur');
			
			$auteur = $this->find(['cond' => 'id_auteur = '. $idAuteur])[0];

			return $auteur;
		}

		public function consulte($id_lecteur, $id_ouvrage)
		{
			$this->setTable('consulter');
			return $this->add([
				'id_lect' => $id_lecteur,
				'id_ouvrage' => $id_ouvrage
			]);
		}

		public function hasAlreadyConsulte($id_lecteur, $id_ouvrage)
		{
			$this->setTable('consulter');
			return $this->findOne([
				'id_lect' => $id_lecteur,
				'id_ouvrage' => $id_ouvrage
			]);	
		}

		public function nbreVueOuvrage($id_ouvrage)
		{
			$this->setTable('consulter');
			return $this->count([
				'cond' => 'id_ouvrage='.$id_ouvrage
			]);
		}
	}


 ?>