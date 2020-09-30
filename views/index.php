<main role="main">
	<section class="jumbotron text-center">
        <div class="container">
          	<h1 class="jumbotron-heading">Bibliothèque Numérique</h1>
          	<p class="lead text-muted">Découvrez des milliers ouvrages et articles mises à votre disposition pour votre épanouissement scientifique et nourir vos travaux et vos recherches...</p>
			<p>
				<a href="ouvrages" class="btn btn-primary my-2">Voir plus <i class="fa fa-angle-double-right"></i></a>
			</p>
        </div>
    </section>

	<div class="album py-5 bg-light">
		<div class="container">
			<h3>Quelques catégories</h3>
			<hr>

			<div class="row">
				<?php foreach ($categories as $categorie): ?>
					<div class="col-md-4">
						<div class="card mb-4 box-shadow">
							<img class="card-img-top catImg" src="assets/img/<?= $categorie->img ?>" alt="Card image cap">
							<div class="card-body">
								<h5 class="card-title"><?= $categorie->libelle_cat ?></h5>
								<p class="card-text"><?= $categorie->resume ?></p>
								<div class="d-flex justify-content-between align-items-center">
										<div class="btn-group">
											<a href="ouvrages/<?= parse_slug($categorie->libelle_cat).'_'.$categorie->id_cat ?>" class="btn btn-sm btn-outline-secondary"><?= $catMod->countOuvragesOfACategorie(['cond' => 'id_cat = '.$categorie->id_cat]) ?> ouvrages</a>
										</div>
										<small class="text-muted">9 mins</small>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach ?>
				
			</div>
			<a class="btn btn-outline-primary float-right" href="#">Voir plus <i class="fa fa-angle-double-right"></i></a>
		</div>
	</div>
</main>