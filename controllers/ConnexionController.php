<?php 
	/**
	 * Gère la connexion des utilisateurs
	 */
	class ConnexionController extends Controller
	{
		public function login()
		{
			if ($this->user->isAuthentificated()) {
				$this->request->redirect(WEBSITE_URL);
			}

			$this->page->addVar('title', 'Connexion');
			if (!$this->request->postExists('tel') || !$this->request->postExists('password')) {
				$this->page->render();
			}else{
				$erreurs = [];
				$tel = $this->request->postData('tel');
				$password = $this->request->postData('password');

				if (!is_tel($tel)) {
					$erreurs[] = 'Numéro de téléphone incorrect.';
				}

				if (strlen($password) < 8) {
					$erreurs[] = 'Mot de passe minimum 8 caractères';
				}

				

				if (count($erreurs) === 0) {
					if ($lecteur = $this->model->findLecteur(['cond' => 'numTel = '.$tel.' AND password = '.$password])) {
						// debug($lecteur);
						if ($lecteur->numTel == '+243826302208') {
							$this->user->setAttribute('admin', true);
						}

						$this->user->setAttribute('id_lecteur', $lecteur->id_lect);
						$this->user->setAttribute('nom_lecteur', $lecteur->nom);
						$this->user->setAttribute('prenom_lecteur', $lecteur->prenom);
						$this->user->setAuthentificated(true);

						if ($url = $this->user->getAttribute('url_redirect')) {
							$this->request->redirect(WEBSITE_URL.$url);
						}

						$this->request->redirect(WEBSITE_URL);
					}else{
						$erreurs[] = 'Numéro de téléphone ou mot de passe incorrect';
					}
				}

				$this->user->setFlash($erreurs, 'danger');
				$this->page->addVar('flash', $this->user->getFlash());
				$this->page->addVar('tel', $tel);
				$this->page->render();
			}
			
		}

		public function logout()
		{
			$_SESSION = [];
			$this->user->setFlash('Vous êtes deconnecté !');
			$this->request->redirect(WEBSITE_URL);
		}

		public function register()
		{
			if ($this->user->isAuthentificated()) {
				$this->request->redirect(WEBSITE_URL);
			}

			$this->page->addVar('title', 'Inscription');

			if ($this->request->postExists('register')) {
				
				$erreurs = [];

				extract($_POST);


				if ($this->request->notEmpty(['nom', 'prenom', 'tel', 'password', 'conf_password', 'sexe'])) {

					// debug($sexe);

					if (is_numeric($nom) || is_numeric($prenom) || is_numeric($sexe)) {
						$erreurs[] = '<strong>Nom, Prénom et Sexe</strong> ne doivent pas être numérique.';
					}

					if (strlen($nom) < 3) {
						$erreurs[] = 'Nom doit avoir minimum 3 caractères';
					}

					if (strlen($prenom) < 3) {
						$erreurs[] = 'Prénom doit avoir minimum 3 caractères';
					}

					if (!is_tel($tel)) {
						$erreurs[] = 'Numéro de téléphone invalide <strong>(Ex: +243...)</strong>';
					}else{
						
						if ($numTel = $this->model->isAlreadyUsed('lecteur', ['cond' => 'numTel = '.$tel, 'champs' => 'numTel'])) {

							$erreurs[] = 'Numéro de téléphone est déjà utilisé';
						}
					}

					if (strlen($password) < 8) {
						$erreurs[] = 'Mot de passe minimum 8 caractères';
					}else{
						if ($password !== $conf_password) {
							$erreurs[] = 'Le deux mot de passe ne correspondent pas';
						}
					}

					if ($sexe != 'M' && $sexe != 'F') {
						$erreurs[] = 'Sexe doit être <strong>M</strong> ou <strong>F</strong>';
					}

					if (count($erreurs) == 0) {
						$this->model->add([
							'nom' => $nom,
							'prenom' => $prenom,
							'sexe' => $sexe,
							'numTel' => $tel,
							'password' => $password
						]);

						$idLecteur = $this->model->findOne(['champs' => 'id_lect', 'cond' => 'numTel='.$tel]);

						

						$this->user->setAttribute('id_lecteur', $idLecteur->id_lect);
						// debug($this->user->getAttribute('id_lecteur'));
						$this->user->setAttribute('nom_lecteur', $nom);
						$this->user->setAttribute('prenom_lecteur', $prenom);
						$this->user->setAuthentificated(true);

						$this->user->setFlash('Votre compte est bien enregistré.', 'success');
						$this->request->redirect(WEBSITE_URL.'ouvrages');
					}
				}else{
					$erreurs[] = 'Veuillez remplir tous les champs';
				}

				$this->user->setFlash($erreurs, 'danger');
				$this->page->addVar('flash', $this->user->getFlash());
				$this->page->addVar('nom', $nom);
				$this->page->addVar('prenom', $prenom);
				$this->page->addVar('sexe', $sexe);
				$this->page->addVar('tel', $tel);
			}

			$this->page->render();
		}
	}


 ?>