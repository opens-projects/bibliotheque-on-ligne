<?php 
	/**
	 * SouscribeController
	 */
	class SubscribeController extends Controller
	{
		public function index()
		{
			$this->model->setTable('abonnement');
			$this->page->addVar('subs', $this->model->find());
			$this->page->addVar('title', 'Abonnement');
			$this->page->render();
		}

		public function subscribe()
		{
			// debug($this->user->getAttribute('id_lecteur'));
			if ($this->user->isAuthentificated()) {
				$id_abon = (int) $this->request->getData('id_abon');
				$id_lect = (int) $this->user->getAttribute('id_lecteur');
				// debug($id_lect);
				$dateDebut = date('Y-m-d');
				$annee = date('Y');
				$anneeFin = $annee + 1;
				$dateFin = date($anneeFin.'-m-d');

				$this->model->setTable('abonnement');
				$abonnement = $this->model->findOne(['cond' => 'id_abonnement='.$id_abon]);
				// $this->model->setPrimaryKey('id');
				// $this->model->update([
				// 	'id' => 2,
				// 	'nbre_ouvrage_a_lire' => 5,
				// 	'nbre_ouvrage_a_telec' => 2
				// ]);
				// debug($abonnement);

				$subData = [
					'id_lect' => $id_lect,
					'id_abonnement' => $id_abon,
					'annee_debut' => $dateDebut,
					'annee_fin' => $dateFin,
					'nbre_ouvrage_a_lire' => $abonnement->nbre_ouvrage_lire,
					'nbre_ouvrage_a_telec' => $abonnement->nbre_ouvrage_telec
				];

				$already = false;

				if ($userAbon = $this->user->hasSubscribe($this)) {
					// debug($userAbon);
					$this->model->setPrimaryKey('id');

					$aLire = $abonnement->nbre_ouvrage_lire + $userAbon->nbre_ouvrage_a_lire;
					$aTelec = $abonnement->nbre_ouvrage_telec + $userAbon->nbre_ouvrage_a_telec;
					$already = true;
					$subData['id'] = $userAbon->id;
					$subData['nbre_ouvrage_a_lire'] = $aLire;
					$subData['nbre_ouvrage_a_telec'] = $aTelec;
					// debug($subData);
					// $subscribe = $this->model->update
				}

				$subscribe = $this->model->subscribe($subData, $already);

				if ($subscribe) {
					
					$this->user->setFlash('Vous avez souscrit pour l\'abonnement <strong>'.$abonnement->type, 'success');
					if ($this->user->getAttribute('url_redirect')) {
						$this->request->redirect(WEBSITE_URL.$this->user->getAttribute('url_redirect'));
					}
					$this->request->redirect(WEBSITE_URL.'ouvrages');
				}
			}else{
				$this->user->setAttribute('url_redirect', $this->request->getData('url'));
				$this->user->setFlash('Veuillez vous connecter pour souscrire à ce prix');
				$this->request->redirect(WEBSITE_URL.'connexion');
			}
		}
	}


 ?>