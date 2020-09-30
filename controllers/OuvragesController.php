<?php 
	/**
	 * OuvragesController
	 */
	class OuvragesController extends Controller
	{
		public function index()
		{
			$this->model->setTable('categorie');
			$categories = $this->model->find();
			require 'models/CategoriesModel.php';
			$catMod = new CategoriesModel;

			$this->page->addVar('catMod', $catMod);
			$this->page->addVar('title', 'Les différentes catégories des ouvrages');
			$this->page->addVar('categories', $categories);
			$this->page->render();
		}

		public function categorie()
		{
			// debug($_GET);
			$slug = $this->request->getData('slug');
			$id_cat = (int) $this->request->getData('id_cat');

			$this->model->setTable('ouvrage');
			$ouvrages = $this->model->find(['cond' => 'id_cat = '.$id_cat]);
			$this->model->setTable('categorie');

			$cat = $this->model->findOne([
				'cond' => 'id_cat = '.$id_cat,
				'champs' => 'libelle_cat'
			]);

			
			$this->page->addVar('title', unparse_slug($slug));
			$this->page->addVar('model', $this->model);
			$this->page->addVar('ouvrages', $ouvrages);
			$this->page->addVar('cat', $cat);
			$this->page->render();
			// Config::debug($ouvrages);
		}

		public function ouvrage()
		{
			if (!$this->user->isAuthentificated()) {
				$slug_ouvrage = ucfirst(unparse_slug($this->request->getData('slug_ouvrage')));
				$this->user->setFlash('Veuillez vous connecter pour lire : <strong>'.$slug_ouvrage.'</strong>');
				$this->user->setAttribute('url_redirect', $this->request->getData('url'));
				$this->request->redirect(WEBSITE_URL.'connexion');
			}

			if (!$this->user->hasSubscribe($this)) {
				$this->user->setFlash('Veuillez vous abonner pour lire ce document.');
				$this->user->setAttribute('url_redirect', $this->request->getData('url'));
				$this->request->redirect(WEBSITE_URL.'abonnement');

			}

			$this->model->SetTable('ouvrage');

			$ouvrage = $this->model->find(['cond' => 'id_ouvrage = '.$this->request->getData('id_ouvrage')])[0];

			// S'il n'a pas encore lu
			if (!$this->model->hasAlreadyConsulte($this->user->getAttribute('id_lecteur'), $this->request->getData('id_ouvrage'))) {
				$this->model->consulte($this->user->getAttribute('id_lecteur'), $this->request->getData('id_ouvrage'));
			}

			$this->page->addVar('title', $ouvrage->titre);
			$this->page->addVar('ouvrage', $ouvrage);
			$this->page->addVar('model', $this->model);
			$this->page->addVar('auteur', $this->model->findAuteur($ouvrage->id_ouvrage));
			$this->page->render();

		}

		public function post()
		{
			$this->page->render();
		}
	}

 ?>