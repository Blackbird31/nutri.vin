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
    <div class="container-sm text-center" style="max-width: 540px;">
        <?php include($THEME.'header_public.php'); ?>
        <?php include($content); ?>
    </div>
  </body>
  <script src="<?php echo $urlbase; ?>/js/bootstrap.bundle.min.js"></script>
</html>
