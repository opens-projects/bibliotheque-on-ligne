<?php 
	/**
	 * Dispatcher
	 */
	class Dispatcher
	{
		
		public $url;
		public $page;

		public function __construct()
		{
			$this->page = new Page;

			$this->getController();

			// $this->loadModel();
		}

		public function getController()
		{

			$router = new Router;

			$xml = new \DOMDocument;
			$xml->load('config/routes.xml');
			$routes = $xml->getElementsByTagName('route');

			// On parcours les routes du fichier XML
			foreach ($routes as $route) {
				$vars = [];

				// On regarde si des variables sont présentes dans URL
				if ($route->hasAttribute('vars')) {
					$vars = explode(',', $route->getAttribute('vars'));
				}

				// On ajoute la route au routeur
				$router->addRoute(new Route($route->getAttribute('url'), $route->getAttribute('controller'), $route->getAttribute('action'), $vars));
			}

			// $matchedRoute = $router->getRoute($this->httpRequest->requestURI());

			if (!$matchedRoute = $router->getRoute(Route::request())) {
				$this->page->error404();
			}

			// On ajoute les variables de l'URL au tableau $_GET
			// debug($matchedRoute->vars());
			if (count($matchedRoute->vars()) > 0) {
				// debug($matchedRoute->vars());
				$_GET = array_merge($_GET, $matchedRoute->vars());
			}

			// On instance le controller
			$controllerClass = ucfirst($matchedRoute->controller()).'Controller';

			$fileController = 'controllers/'.$controllerClass.'.php';

			if (file_exists($fileController)) {
				require $fileController;
				
				return new $controllerClass($matchedRoute->controller(), $matchedRoute->action(), $matchedRoute->vars());
			}else{
				$this->page->error404();
			}
			
			
		}

		public function parse()
		{
			$url = $this->url;
			$url = preg_replace('#\/#', '', $url);

			return $url;

		}
	}




 ?>