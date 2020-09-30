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
<div class="text-center mt-5">
  <form class="form-signin" method="post" action="<?= WEBSITE_URL ?>connexion" autocomplete="off">
    <h1 class="h3 mb-3 font-weight-normal">Connexion</h1>
    <label for="inputEmail" class="sr-only">Téléphone</label>
    <input type="tel" value="<?= isset($tel) ? $tel : '' ?>" name="tel" id="inputEmail" class="form-control" placeholder="Téléphone" required autofocus>
    <label for="inputPassword" class="sr-only">Mot de passe</label>
    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Mot de passe" required>
    
    <button class="btn btn-lg btn-primary btn-block" type="submit">Connexion&nbsp;<i class="fa fa-sign-in"></i></button>
    <p class="mt-4 mb-3"><a href="<?= WEBSITE_URL.'inscription' ?>" class="text-muted">Je veux m'inscire.</a></p>
  </form>
</div>