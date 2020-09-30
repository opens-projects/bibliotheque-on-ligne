<?php if (isset($flash)): ?>
  <div class="col-md-4 offset-4">
    <div class="alert alert-<?= $flash['type'] ?> alert-dismissible fade show" role="alert">
      <?= $flash['message'] ?>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  </div>
<?php endif ?>

<div class="offset-4 col-md-4">
  <h3 class="mb-4 text-center">Veuillez vous inscrire... <i class="fa fa-pencil"></i></h3>
  <form method="post" autocomplete="off" action="<?= WEBSITE_URL ?>inscription">
    <div class="form-group">
      <input type="text" name="nom" placeholder="Nom" id="nom" class="form-control" value="<?= isset($nom) ? $nom : '' ?>" required />
    </div>
    <div class="form-group">
      <input type="text" name="prenom" value="<?= isset($prenom) ? $prenom : '' ?>" placeholder="Prénom" id="prenom" class="form-control" required />
    </div>
    <div class="form-group">
      <input type="text" name="tel" value="<?= isset($tel) ? $tel : '' ?>" placeholder="Téléphone" id="tel" class="form-control" required />
    </div>
    <div class="form-group">
      <select name="sexe" required="required" id="sexe" class="form-control">
        <option>Sexe</option>
        <option value="M" <?= isset($sexe) && $sexe == 'M' ? 'selected' : '' ?>>Homme</option>
        <option value="F" <?= isset($sexe) && $sexe == 'F' ? 'selected' : '' ?>>Femme</option>
      </select>
    </div>
    <div class="form-group">
      <input type="password" name="password" required placeholder="Mot de passe" id="password" class="form-control" />
    </div>
    <div class="form-group">
      <input type="password" name="conf_password" required placeholder="Confirmer mot de passe" id="conf_password" class="form-control" />
    </div>
    <button type="submit" name="register" class="btn btn-lg btn-primary btn-block">Valider&nbsp;<i class="fa fa-check"></i></button>
    <p class="mt-4 mb-3 text-center"><a href="<?= WEBSITE_URL.'connexion' ?>" class="text-muted">J'ai déjà un compte</a></p>
  </form>
</div>