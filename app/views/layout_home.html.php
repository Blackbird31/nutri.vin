<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nutri.Vin - Plateforme open source de QR Code nutritionnel pour le vin</title>
    <meta name="description" content="Plateforme open source et communautaire de QR Code pour la déclaration nutritionnelle de vins" />
	<link href="/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/css/bootstrap-icons.min.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="/css/common.css" rel="stylesheet" />
  </head>
  <body>
    <div class="container-sm p-3"  style="max-width: 768px;">
      <div class="mt-5 text-center">
        <?php include($THEME.'header_home.php'); ?>

        <h1 class="text-primary text-decoration-underline mt-2"><?php echo $_SERVER['HTTP_HOST'] ?></h1><p class="fs-3 mt-5 text-primary">Plateforme <strong>open source</strong> et communautaire de <strong>QR Code</strong> pour la déclaration <strong>nutritionnelle</strong> de vos <strong>vins</strong>
        </p>
        <p class="fs-3 mt-5 text-primary">
            Ouverture le 1er juin 2024
        </p>
        <a href="https://framaforms.org/ouverture-de-nutrivin-1706284140" class="btn btn-primary bg-primary border-primary btn-lg mt-5 rounded-pill" type="button">
          <i class="bi bi-envelope-plus text-warning"></i>&nbsp;&nbsp;Me le rappeler
        </a>
        <div class="mt-4">
          <a class="btn btn-link text-primary" href="https://github.com/24eme/nutri.vin">Voir le code source</a>
        </div>
      </div>
    </div>
  </body>
</html>
