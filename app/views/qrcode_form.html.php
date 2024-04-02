<h2>Création d'un vin</h2>

<form method="POST" action="<?php echo $urlbase; ?>/qrcode/write">
<?php if (isset($qrcode->id)): ?>
    <input type="hidden" name="id" value="<?php echo $qrcode->id; ?>" />
<?php endif; ?>

<h3>Information commerciale</h3>

  <div class="form-floating mb-3">
      <input type="text" class="form-control" id="domaine_nom" name="domaine_nom" placeholder="Mon domaine" value="<?php echo $qrcode->domaine_nom; ?>"/>
      <label for="domaine_nom">Nom du Domaine</label>
  </div>

<h3>Information relative au vin</h3>

  <div class="form-floating mb-3">
      <input type="text" class="form-control" id="cuvee_nom" placeholder="Ma cuvée" value="<?php echo $qrcode->cuvee_nom; ?>"/>
      <label for="cuvee_nom">Nom de la cuvee</label>
  </div>

  <div class="form-floating mb-3">
      <input type="text" class="form-control" id="appellation" name="appellation" value="<?php echo $qrcode->appellation; ?>" placeholder="Appellation"/>
      <label form="appellation" class="form-label">Appellation</label>
  </div>
  <div class="form-floating mb-3">
      <input type="text" class="form-control" id="couleur" name="couleur" value="<?php echo $qrcode->couleur; ?>" placeholder="Couleur"/>
      <label form="couleur" class="form-label">Couleur</label>
  </div>

  <h3>Information complémentaires</h3>
  <div class="mb-3">
      <label form="alcool_degre" class="col-sm-2 col-form-label">Degré d'alcool</label>
      <div class="col-sm-10">
        <div class="input-group">
          <input type="text" class="form-control" id="alcool_degre" name="alcool_degre" value="<?php echo $qrcode->alcool_degre; ?>" placeholder="Alcool"/>
          <span class="input-group-text" id="basic-addon2">%</span>
        </div>
      </div>
  </div>

  <div class="row">
  <div class="mb-3">
      <label form="quantite" class="col-sm-2 col-form-label">Centilisation</label>
      <div class="input-group col-sm-10">
          <input type="text" class="form-control" id="quantite" name="quantite" value="<?php echo $qrcode->centilisation; ?>" placeholder="Centilisation"/>
          <span class="input-group-text" id="basic-addon2">cl</span>
      </div>
  </div>

  <div class="mb-3">
    <label form="millesime" class="col-sm-2 col-form-label">Millesime</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="millesime" name="millesime" value="<?php echo $qrcode->millesime; ?>" placeholder="Millesime"/>
    </div>
  </div>

  <h3>Photos de l'étiquette</h3>
  <div class="mb-3">
      <label form="etiquette" class="col-sm-2 form-label">Étiquette</label>
      <div class="col-sm-10">
      <input type="text" class="form-control" id="etiquette" name="etiquette" value="<?php echo $qrcode->etiquette; ?>" placeholder="Étiquette"/>
      </div>
  </div>
</div>

<h3>Liste des ingrédients</h3>
  <div class="form-floating mb-3">
      <textarea type="text" class="form-control" id="ingredients" name="ingredients" value="<?php echo $qrcode->ingredients; ?>" style="height: 100px"></textarea>
      <label form="ingredients" class="form-label">Ingredients</label>
      <div id="ingredients_help" class="form-text">ingredients</div>
  </div>

<h3>Information nutritionelle</h3>
  <div class="form-floating mb-3">
      <input type="text" class="form-control" id="nutritionnel" name="nutritionnel" value="<?php echo $qrcode->nutritionnel; ?>"/>
      <label form="nutritionnel" class="form-label">Nutritionnel</label>
      <div id="nutritionnel_help" class="form-text">nutritionnel</div>
  </div>

  <?php if ($qrcode->exists('authorization_key')): ?>
  <input type="hidden" name="authorization_key" value="<?php echo $qrcode->authorization_key; ?>"/>
  <?php endif; ?>
  <button type="submit" class="btn btn-primary">Créer le vin</button>
</form>
