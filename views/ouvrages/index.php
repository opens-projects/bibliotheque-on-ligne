<div class="mon-container">
	<h5>
    <a href="<?= WEBSITE_URL ?>/ouvrages">OUVRAGES</a>&nbsp;<i class="fa fa-chevron-right" style="font-size: 20px;"></i>&nbsp;
    <?= isset($cat) 
        ? '<a href="#">'.strtoupper($cat->libelle_cat).' </a>'
        : ''
    ?>
  </h5>

  <?php if (isset($categories)): ?>
      <div class="row mt-5">
        <?php foreach ($categories as $categorie): ?>
          <div class="col-md-4">
            <div class="card mb-4 box-shadow">
              <img class="card-img-top catImg" src="<?= WEBSITE_URL ?>/assets/img/<?= $categorie->img ?>" alt="Card image cap">
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
  <?php endif ?>
</div>