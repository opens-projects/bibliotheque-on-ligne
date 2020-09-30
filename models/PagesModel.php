<?php 
	/**
	 * Contient des requêtes se trouvant à l'accueil
	 */
	class PagesModel extends Model
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
	}


 ?>