<?php 
	/**
	 * Route
	 * @description : Gère toutes les routes
	 */
	class Route
	{
		protected $action;
		protected $controller;
		public $url;
		protected $varsNames;
		protected $vars = [];

		public function __construct($url, $controller, $action, array $varsNames)
		{
			$this->setUrl($url);
			$this->setController($controller);
			$this->setAction($action);
			$this->setVarsNames($varsNames);
		}

		public static function request()
		{
			$donnees = [];

			if (isset($_SERVER['PATH_INFO'])) {
				return $_SERVER['PATH_INFO'];

			}else{
				return '/';
			}
			
		}

		public function hasVars()
		{
			return !empty($this->varsNames);
		}

		public function match($url)
		{

			if (preg_match('#^' . $this->url . '$#',$url, $matches)) {
				// debug($matches);
				for ($i=0; $i < count($matches); $i++) { 
					if ($i > 0 && is_paire($i)) {
						$matches[$i] = preg_replace('#_#', '', $matches[$i]);
					}
				}
		
				return $matches;
			}else{
				return false;
			}
		}

		public function setAction($action)
		{
			if (is_string($action)) {
				$this->action = $action;
			}
		}

		public function setUrl($url)
		{
			if (is_string($url)) {
				$this->url = $url;
			}
		}

		public function setController($controller)
		{
			if (is_string($controller)) {
				$this->controller = $controller;
			}
		}

		public function setVarsNames(array $varsNames)
		{
			$this->varsNames = $varsNames;
		}

		public function setVars($vars)
		{
			$this->vars = $vars;
		}

		public function action()
		{
			return $this->action;
		}

		public function controller()
		{
			return $this->controller;
		}

		public function vars()
		{
			return $this->vars;
		}

		public function varsNames()
		{
			return $this->varsNames;
		}
	}

 ?>