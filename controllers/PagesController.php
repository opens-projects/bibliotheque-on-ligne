<?php 
	/**
	 * PagesController
	 */
	class PagesController extends Controller
	{

		public function index()
		{
			$this->model->SetTable('categorie');
			$categories = $this->model->find(['limit' => '0,3']);
			require 'models/CategoriesModel.php';
			$catMod = new CategoriesModel;

			// Config::debug($catMod->countOuvragesOfACategorie(['cond' => 'id_cat = 2']));

			$this->page->addVar('title', 'Découvrez des milliers ouvrages');
			$this->page->addVar('categories', $categories);
			$this->page->addVar('catMod', $catMod);

			$this->page->setContentFile('index');
			$this->page->render();
		}

		public function search()
		{
			if ($this->request->postData('query')) {
				$results = $this->model->search($this->request->postData('query'));
				// debug($results);
				$this->page->setContentFile('search');
				$this->page->addVar('results', $results);
				$this->page->addVar('model', $this->model);
				
			}
			
			$this->page->render();
		}

	}


 ?>