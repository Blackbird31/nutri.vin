<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nutri.Vin - Plateforme open source de QR Code nutritionnel pour le vin</title>
    <meta name="description" content="Plateforme open source et communautaire de QR Code pour la déclaration nutritionnelle de vins" />
	  <link href="<?php echo $urlbase; ?>/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo $urlbase; ?>/css/bootstrap-icons.min.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="<?php echo $urlbase; ?>/css/nutrivin.css" rel="stylesheet" />
  </head>
  <body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
      <a class="navbar-brand" href="<?php echo $urlbase; ?>/qrcode/userid/list"><img src="/images/logo.svg" class="mx-auto d-block" alt="Logo nutrivin" width="42" height="42"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="<?php echo $urlbase; ?>/qrcode/userid/list">Mes QRCodes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Déconnexion</a>
          </li>
        </ul>
      </div>
    </div>
    </nav>

    <div class="container-sm p-3">
        <?php include($content); ?>
    </div>
  </body>
  <script src="<?php echo $urlbase; ?>/js/jquery-3.7.1.min.js"></script>
  <script src="<?php echo $urlbase; ?>/js/bootstrap.bundle.min.js"></script>
</html>
