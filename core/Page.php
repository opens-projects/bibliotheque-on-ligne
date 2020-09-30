<?php 
	/**
	 * Page
	 */
	class Page
	{
		protected $contentFile;
		protected $vars = [];
		protected $template = 'views/layout.php';

		public function addVar($var, $value)
		{
			if (!is_string($var) || is_numeric($var) || empty($var)) {
				throw new InvalidArgumentException('Le nom de la variable doit être une chaîne de caratères non nulle');
			}

			$this->vars[$var] = $value;
		}

		public function render()
		{
			$vars = $this->vars;

			if (!empty($vars)) {
				extract($vars);
			}

			$fileView = 'views/'.$this->contentFile.'.php';

			if (file_exists($fileView)) {
				$filename = $fileView;
			}else{
				$this->error404();
			}
			
			ob_start();
			require $filename;
			$content = ob_get_clean();

			require $this->template;
		}

		public function setTemplate($template)
		{
			$this->template = $template;
		}

		public function error404()
		{
			$this->setTemplate('views/error.php');
			$this->setContentFile('errors/404');
			header('HTTP/1.0 404 Not Found');
			$this->render();
			die();
			// header('Location: views/error404.php');
		}

		public function setContentFile($contentFile)
		{
			// die($contentFile);

			if (!is_string($contentFile) || empty($contentFile)) {
				throw new \InvalidArgumentException('La vue spécifiée est invalide', 1);
				
			}

			$this->contentFile = $contentFile;
		}
	}

 ?>