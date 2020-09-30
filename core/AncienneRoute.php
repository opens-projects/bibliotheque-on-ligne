<?php 
	/**
	 * Permet de décrire les routes
	 */
	class Route
	{
		public static function getUrl()
		{
			$donnees = [];

			if (isset($_SERVER['PATH_INFO'])) {
				$url = $_SERVER['PATH_INFO'];
				// Config::debug($url);
				$urls = explode('/', $url);
				
				$donnees['url'] = $urls[1];

				if (count($urls) > 2) {
					if (!empty($urls[2])) {
						$donnees['params'] = $urls[2];
						return $donnees;
					}
				}

				// Config::debug($donnees);

				return $donnees;

			}else{
				return 'pages';
			}
			
		}

		public function match($url)
		{
			// return $this->url;

			if (preg_match('#^' . $this->url . '$#',$url, $matches)) {
				// Config::debug($matches);
				return $matches;
			}else{
				return false;
			}
		}

	}



 ?>