<div class="mon-container">
	<h5>
    <a href="<?= WEBSITE_URL ?>/ouvrages">OUVRAGES</a>&nbsp;<i class="fa fa-chevron-right" style="font-size: 20px;"></i>&nbsp;
    <?= isset($cat) 
        ? '<a href="#">'.strtoupper($cat->libelle_cat).' </a>'
        : ''
    ?>
  </h5>
	
  <?php if (isset($ouvrages)): ?>
    <div class="row mt-5">
      <?php foreach ($ouvrages as $ouvrage): ?>
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
  
  <?php endif ?>
</div>