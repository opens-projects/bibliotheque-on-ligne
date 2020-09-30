<div class="container">
  <?php if (isset($results)): ?>
    <?php if (!empty($results)): ?>
      <div class="row mt-5">
          <?php foreach ($results as $ouvrage): ?>
            <div class="col-md-4">
              <div class="card flex-md-row mb-4 box-shadow h-md-250">
                <div class="card-body d-flex flex-column align-items-start">
                  <strong class="d-inline-block mb-2 text-primary"><?= strtoupper($model->findAuteur($ouvrage->id_ouvrage)->nom . ' ' . $model->findAuteur($ouvrage->id_ouvrage)->prenom) ?></strong>
                  <h3 class="mb-0">
                    <a class="text-dark" href="#"><?= $ouvrage->titre ?></a>
                  </h3>
                  <div class="mb-1 text-muted"><?= format_date(new DateTime($ouvrage->created)) ?></div>
                  <p class="card-text mb-auto"><?= $ouvrage->resume ?></p>
                  <a href="<?= lien(parse_slug($ouvrage->titre).'_'.$ouvrage->id_ouvrage) ?>" class="btn btn-outline-primary mt-3">Lire <i class="fa fa-angle-double-right"></i></a>
                </div>
              </div>
            </div>
          <?php endforeach ?>
        </div>
    <?php else: ?>
      <h1 style="text-align: center;">Aucun ouvrage de nom a été trouvé...</h1>
    <?php endif ?>
  <?php else: ?>
    <h1 style="text-align: center;">Veuillez saisir quelque chose sur la barre de recherche...</h1>
  <?php endif ?>
</div>