<?php 
	/**
	 * InscriptionController
	 */
	class InscriptionController extends Controller
	{
		public function index()
		{
			$this->page->addVar('title', 'Inscription');
			$this->page->render();
		}
	}

 ?>