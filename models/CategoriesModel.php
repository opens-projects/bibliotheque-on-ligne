<?php 
	/**
	 * Le model pour les catégories
	 */
	class CategoriesModel extends Model
	{
		public function countOuvragesOfACategorie($contraintes = [])
		{
			$this->setTable('ouvrage');
			return $this->count($contraintes);
		}
	}


 ?>