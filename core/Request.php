<?php 
	/**
	 * Gère les différentes requêtes http
	 */
	class Request
	{
		public function cookieData($key)
		{
			return isset($_COOKIE[$key]) ? $_COOKIE[$key] : null;
		}

		public function cookieExists($key)
		{
			return isset($_COOKIE[$key]);
		}

		public function getData($key)
		{
			return isset($_GET[$key]) ? $_GET[$key] : null;
		}

		public function postData($key)
		{
			return isset($_POST[$key]) ? $_POST[$key] : null;
		}

		public function getExists($key)
		{
			return isset($_GET[$key]);
		}

		public function method()
		{
			return $_SERVER['REQUEST_METHOD'];
		}

		public function notEmpty($fields = [])
		{
			if (count($fields) != 0) {
                foreach ($fields as $field) {
                    if (empty($_POST[$field]) || trim($_POST[$field]) == "") {
                        return false;
                    }
                }
                
                return true;
            }
		}

		public function postExists($key)
		{
			return isset($_POST[$key]);
		}

		public function redirect($location)
		{
			header('Location: '.$location);
			exit();
		}

		public function requestURI()
		{
			return isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/';
		}
	}


 ?>