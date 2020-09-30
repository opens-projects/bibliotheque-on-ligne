<main role="main" style="background-color: #f8f8f8;margin-top: -15px;padding-top: 20px;background-size: cover;">
	<div class="container" style="background-color: #ffffff;padding-top: 100px;">
		<h1 class="text-center" style="padding-bottom: 40px;"><?= $ouvrage->titre ?></h1>
		<h5 class="text-center mt-5"><i>Par <?= $auteur->prenom . ' ' . $auteur->prenom ?></i></h5>
		<p class="text-center mt-4" style="margin-bottom: 170px;"><i><?= format_date(new DateTime($ouvrage->created)) ?></i></p>
		<p class="text-center">(<?= $model->nbreVueOuvrage($ouvrage->id_ouvrage) ?> vues)</p>
		<hr>
		<div class="px-5">
			<!-- <p>
				<i>Résumé : </i><br/>
				<i>« <?= $ouvrage->resume ?> »</i>
			</p> -->

			<div>
				<?= $ouvrage->contenu ?>
			</div>
		</div>
	</div>
</main>