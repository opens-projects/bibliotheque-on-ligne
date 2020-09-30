<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>
			<?=
				isset($title) ? $title . ' - ' . WEBSITE_NAME : WEBSITE_NAME
			 ?>
		</title>
		<link rel="stylesheet" href="<?= WEBSITE_URL ?>assets/css/bootstrap.css" />
    <link rel="stylesheet" href="<?= WEBSITE_URL ?>assets/css/style.css" />
		<link rel="stylesheet" href="<?= WEBSITE_URL ?>assets/css/font-awesome.css" />
	</head>
	<body>
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
      <h5 class="my-0 mr-md-auto font-weight-normal"><a href="<?= WEBSITE_URL ?>" style="text-decoration: none;">BIBLIOTHEQUE NUMERIQUE</a></h5>
      <form action="<?= WEBSITE_URL.'search' ?>" method="post">
        <input type="search" name="query" id="query" placeholder="Rechercher un ouvrage..." style="margin-right: 0;border: 1px solid #aaa;height: 30px;padding-left: 10px;padding-right: 10px;border-radius: 4px;width: 300px;" />
        <button type="submit" style="margin-left: -5px;border: 1px solid #aaa;height: 30px;"><i class="fa fa-search"></i></button>
      </form>
      <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark" href="<?= WEBSITE_URL ?>ouvrages">Ouvrages</a>
        <a class="p-2 text-dark" href="<?= WEBSITE_URL ?>abonnement">Abonnement</a>
        <?php if ($user->isAdmin()): ?>
          <a class="p-2 text-dark" href="<?= WEBSITE_URL ?>publier">Publier</a>
        <?php endif ?>
      </nav>
      <?php if (!$user->isAuthentificated()): ?>
      	<a class="btn btn-outline-primary mr-3" href="<?= WEBSITE_URL ?>connexion"><i class="fa fa-sign-in"></i> Connexion</a>
      	<a class="btn btn-primary" href="<?= WEBSITE_URL ?>inscription"><i class="fa fa-pencil"></i> Inscription</a>
      <?php else: ?>
      	<a href=""></a>
      	<span><?= $user->getAttribute('prenom_lecteur') ?></span>
      	<img src="<?= WEBSITE_URL ?>assets/img/avatar_default.jpg" alt="" class="rounded-circle avatar-lecteur ml-2">
      	<a class="btn btn-outline-primary ml-3" href="<?= WEBSITE_URL ?>deconnexion">Déconnexion <i class="fa fa-sign-out"></i></a>
      <?php endif ?>
      
    </div>
    <?php if ($user->hasFlash()): ?>
      <?php $flash = $user->getFlash(); ?>
      <div class="col-md-6 offset-3 text-center">
        <div class="alert alert-<?= $flash['type'] ?> alert-dismissible fade show" role="alert" id="msgAlert">
          <?= $flash['message'] ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      </div>
    <?php endif ?>

		<?php echo $content ?>
		
		<script src="<?= WEBSITE_URL ?>assets/js/jquery.min.js"></script>
    <script src="<?= WEBSITE_URL ?>assets/js/bootstrap.js"></script>
		<script src="<?= WEBSITE_URL ?>assets/js/main.js"></script>
	</body>
</html>