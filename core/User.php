<?php 
	session_start();

	/**
	 * User
	 */
	class User
	{
		public function getAttribute($attr)
		{
			return isset($_SESSION[$attr]) ? $_SESSION[$attr] : null;
		}

		public function getFlash()
		{
			$flash = $_SESSION['flash'];
			unset($_SESSION['flash']);

			return $flash;
		}

		public function hasFlash()
		{
			return isset($_SESSION['flash']);
		}

		public function isAuthentificated()
		{
			return isset($_SESSION['auth']) && $_SESSION['auth'] === true;
		}

		public function isAdmin()
		{
			return isset($_SESSION['admin']) ? $_SESSION['admin'] : false;
		}

		public function setAttribute($attr, $value)
		{
			$_SESSION[$attr] = $value;
		}

		public function setAuthentificated($authenticated = true)
		{
			if (!is_bool($authenticated)) {
				throw new \InvalidArgumentException('La valeur spécifiée à la méthode User::setAuthentificated() doit être un boolean');
			}

			$_SESSION['auth'] = $authenticated;
		}

		public function setFlash($value, $type = 'info')
		{
			$_SESSION['flash'] = [];

			if (is_array($value)) {

				$_SESSION['flash']['message'] = '';

				foreach ($value as $v) {
					$_SESSION['flash']['message'] .= $v . '<br />';
				}
			}else{
				$_SESSION['flash']['message'] = $value;
			}
			
			$_SESSION['flash']['type'] = $type;
		}

		public function hasSubscribe(Controller $c)
		{
			$id_lect = $c->user->getAttribute('id_lecteur');

			$c->model->setTable('souscrire');
			$res = $c->model->findOne([
				'cond' => 'id_lect='.$id_lect.' AND nbre_ouvrage_a_lire > 0'
			]);
			
			return $res;
		}
	}

 ?>