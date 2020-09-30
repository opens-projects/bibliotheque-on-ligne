<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
      <h1 class="display-4">Abonnement</h1>
      <p class="lead">Voici nos différents prix qui vous donnent la possibilité de consulter un bon nombre d'ouvrages avec des prix abordables pour que tous.<br> Alors qu'attendez-vous ?</p>
    </div>

    <div class="container">
      <div class="card-deck mb-3 text-center">
        <?php if ($subs): ?>
          <?php foreach ($subs as $sub): ?>
            <div class="card mb-4 box-shadow">
              <div class="card-header">
                <h4 class="my-0 font-weight-normal"><?= $sub->type ?></h4>
              </div>
              <div class="card-body">
                <h1 class="card-title pricing-card-title">$<?= $sub->montant ?> <small class="text-muted">/ an</small></h1>
                <ul class="list-unstyled mt-3 mb-4">
                  <li><?= $sub->nbre_ouvrage_lire ?> ouvrages à lire</li>
                  <li><?= $sub->nbre_ouvrage_telec ?> ouvrages à télécharger</li>
                  <li><?= $sub->slogan ?></li>
                </ul>
                <?php if ($sub->id_abonnement == 1): ?>
                  <a href="abonnement/<?= $sub->id_abonnement ?>" class="btn btn-lg btn-block btn-outline-primary">Essayez le Cadosss :-)</a>
                <?php else: ?>
                  <a href="abonnement/<?= $sub->id_abonnement ?>" class="btn btn-lg btn-block btn-primary">Commencer</a>
                <?php endif ?>
              </div>
            </div>
          <?php endforeach ?>
        <?php endif ?>
      </div>
    </div>