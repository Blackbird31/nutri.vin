<h2>Création d'un vin</h2>

<div class="row justify-content-end">
  <div class="col-8">
      <form method="POST" action="<?php echo $urlbase; ?>/qrcode/<?php echo $qrcode->user_id; ?>/write" enctype="multipart/form-data">
      <?php if (isset($qrcode->id)): ?>
          <input type="hidden" name="id" value="<?php echo $qrcode->id; ?>" />
      <?php endif; ?>


      <h3 class="mt-4 mb-4">Information commerciale</h3>

      <div class="form-floating mb-3 col-sm-10">
          <input type="text" class="form-control" id="domaine_nom" name="domaine_nom" placeholder="Mon domaine" value="<?php echo $qrcode->domaine_nom; ?>"/>
          <label for="domaine_nom">Nom du Domaine</label>
      </div>


      <h3 class="mt-4 mb-4">Information relative au vin</h3>


      <div class="form-floating mb-3 col-sm-10">
           <input type="text" class="form-control" id="cuvee_nom" name="cuvee_nom" placeholder="Ma cuvée" value="<?php echo $qrcode->cuvee_nom; ?>"/>
           <label for="cuvee_nom">Nom de la cuvee</label>
       </div>

       <div class="form-floating mb-3 col-sm-10">
           <input type="text" class="form-control" id="appellation" name="appellation" value="<?php echo $qrcode->appellation; ?>" placeholder="Appellation"/>
           <label form="appellation" class="form-label">Appellation</label>
       </div>

       <div class="form-floating mb-3 col-sm-10">
           <input type="text" class="form-control" id="couleur" name="couleur" value="<?php echo $qrcode->couleur; ?>" placeholder="Couleur"/>
           <label form="couleur" class="form-label">Couleur</label>
       </div>


        <h3 class="mt-4 mb-4">Informations complémentaires</h3>

        <div class="mb-3 col-sm-3">
            <label form="alcool_degre" class="col-form-label">Degré d'alcool</label>
              <div class="input-group">
                <input type="text" class="form-control text-sm-end" id="alcool_degre" name="alcool_degre" value="<?php echo $qrcode->alcool_degre; ?>" placeholder="Alcool"/>
                <span class="input-group-text" id="basic-addon2">%</span>
              </div>
        </div>

        <div class="mb-3 col-sm-3">
            <label form="quantite" class="col-form-label">Centilisation</label>
            <div class="input-group">
                <input type="text" class="form-control text-sm-end" id="centilisation" name="centilisation" value="<?php echo $qrcode->centilisation; ?>" placeholder="Centilisation"/>
                <span class="input-group-text" id="basic-addon2">cl</span>
            </div>
        </div>

        <div class="mb-3 col-sm-3">
          <label form="millesime" class="col-form-label">Millesime</label>
            <input type="text" class="form-control text-sm-end" id="millesime" name="millesime" value="<?php echo $qrcode->millesime; ?>" placeholder="Millesime"/>
          </div>

        <h3 class="mt-4 mb-4">Photos de l'étiquette</h3>

        <div class="mb-3">
            <div class="col-sm-10">
<?php if ($qrcode->etiquette) : ?>
                <div class="col-sm-4">
                <img src="<?php echo $qrcode->etiquette ?>" class="img-thumbnail"/><br/>
                <center><a href="./<?php echo $qrcode->id; ?>/img/0/delete">(suppr)</a></center>
                </div>
<?php else:?>
              <label for="etiquette" class="form-label">Fichier étiquette</label>
              <input type="file" class="form-control" id="etiquette" name="etiquette" value="<?php echo $qrcode->etiquette; ?>" placeholder="Étiquette"/>
<?php endif; ?>
            </div>
        </div>

      <h3 class="mt-4 mb-4">Liste des ingrédients</h3>
        <div class="form-floating mb-3 col-sm-10">
            <textarea type="text" class="form-control" id="ingredients" name="ingredients" style="height: 100px"><?php echo $qrcode->ingredients; ?></textarea>
            <label form="ingredients" class="form-label">Ingredients</label>
            <div id="ingredients_help" class="form-text">ingredients</div>
        </div>

      <h3 class="mt-4 mb-4">Informations nutritionelles</h3>

        <div class="form-floating mb-3 col-sm-10">
          <table class="table table-striped">
            <tbody>


              <tr>
                <td class="align-middle">Énergie (kJ)</td>
                  <td>
                    <div class="col-6 offset-6">
                    <div class="input-group">
                      <input type="text" class="form-control text-sm-end" id="nutritionnel_energie_kj" name="nutritionnel_energie_kj" onChange="$('#nutritionnel_energie_kcal').val(parseInt($('#nutritionnel_energie_kj').val()/4.184))" value="<?php echo $qrcode->nutritionnel_energie_kj; ?>"/>
                      <span class="input-group-text" id="basic-addon-cal" style="width:50px">kJ</span>
                    </div>
                  </div>
                  </td>
              </tr>
              <tr>
                <td class="align-middle">Énergie (kcal)</td>
                  <td>
                    <div class="col-6 offset-6">
                    <div class="input-group">
                      <input type="text" class="form-control text-sm-end" id="nutritionnel_energie_kcal" name="nutritionnel_energie_kcal" onChange="$('#nutritionnel_energie_kj').val(parseInt($('#nutritionnel_energie_kcal').val()*4.184))" value="<?php echo $qrcode->nutritionnel_energie_kcal; ?>"/>
                      <span class="input-group-text" id="basic-addon-cal" style="width:50px">kcal</span>
                    </div>
                  </div>
                  </td>
              </tr>


              <tr>
                <td class="align-middle">Graisses</td>
                  <td class="text-sm-start">
                    <div class="col-6 offset-6">
                      <div class="input-group">
                        <input type="text" class="form-control text-sm-end" id="nutritionnel_graisses" name="nutritionnel_graisses" value="<?php echo $qrcode->nutritionnel_graisses; ?>"/>
                        <span class="input-group-text" id="basic-addon-graisses">g</span>
                      </div>
                    </div>
                </td>
              </tr>


              <tr>
                <td class="ps-5 align-middle">- dont acides gras saturés</td>
                <td class="text-sm-start">
                  <div class="col-6 offset-6">
                    <div class="input-group">
                      <input type="text" class="form-control text-sm-end" id="nutritionnel_acides_gras" name="nutritionnel_acides_gras" value="<?php echo $qrcode->nutritionnel_acides_gras; ?>"/>
                      <span class="input-group-text" id="basic-addon-gras">g</span>
                    </div>
                  </div>
                </td>
              </tr>


              <tr>
                <td class="align-middle">Glucides</td>
                <td class="text-sm-start">
                  <div class="col-6 offset-6">
                    <div class="input-group">
                      <input type="text" class="form-control text-sm-end" id="nutritionnel_glucides" name="nutritionnel_glucides" value="<?php echo $qrcode->nutritionnel_glucides; ?>"/>
                      <span class="input-group-text" id="basic-addon-glucides">g</span>
                    </div>
                  </div>
                </td>
              </tr>


              <tr>
                <td class="ps-5 align-middle">- dont sucres</td>
                <td class="text-sm-start">
                  <div class="col-6 offset-6">
                    <div class="input-group">
                      <input type="text" class="form-control text-sm-end" id="nutritionnel_sucres" name="nutritionnel_sucres" value="<?php echo $qrcode->nutritionnel_sucres; ?>"/>
                      <span class="input-group-text" id="basic-addon-sucres">g</span>
                    </div>
                  </div>
                </td>
              </tr>

              <tr>
                  <td class="align-middle">Fibres alimentaires</td>
                  <td class="text-sm-start">
                      <div class="col-6 offset-6">
                          <div class="input-group">
                              <input type="text" class="form-control text-sm-end" id="nutritionnel_fibres" name="nutritionnel_fibres" value="<?php echo $qrcode->nutritionnel_fibres; ?>"/>
                              <span class="input-group-text" id="basic-addon-fibres">g</span>
                          </div>
                      </div>
                  </td>
              </tr>

              <tr>
                <td class="align-middle">Protéines</td>
                <td class="text-sm-start">
                  <div class="col-6 offset-6">
                    <div class="input-group">
                      <input type="text" class="form-control text-sm-end" id="nutritionnel_proteines" name="nutritionnel_proteines" value="<?php echo $qrcode->nutritionnel_proteines; ?>"/>
                      <span class="input-group-text" id="basic-addon-proteines">g</span>
                    </div>
                  </div>
                </td>
              </tr>


              <tr>
                <td class="align-middle">Sel</td>
                <td class="text-sm-start">
                  <div class="col-6 offset-6">
                    <div class="input-group">
                      <input type="text" class="form-control text-sm-end" id="nutritionnel_sel" name="nutritionnel_sel" value="<?php echo $qrcode->nutritionnel_sel; ?>"/>
                      <span class="input-group-text" id="basic-addon-sel">g</span>
                    </div>
                  </div>
                </td>
              </tr>

              <tr>
                <td class="align-middle">Sodium</td>
                <td class="text-sm-start">
                  <div class="col-6 offset-6">
                    <div class="input-group">
                      <input type="text" class="form-control text-sm-end" id="nutritionnel_sodium" name="nutritionnel_sodium" value="<?php echo $qrcode->nutritionnel_sodium; ?>"/>
                      <span class="input-group-text" id="basic-addon-sodium">g</span>
                    </div>
                  </div>
                </td>
              </tr>

            </tbody>
          </table>
        </div>

        <?php if ($qrcode->exists('authorization_key')): ?>
        <input type="hidden" name="authorization_key" value="<?php echo $qrcode->authorization_key; ?>"/>
        <?php endif; ?>
        <button type="submit" class="btn btn-primary">Créer le vin</button>
      </form>
  </div>
  <div class="col-4 text-center border border-primary bg-primary-subtle">
    <h3>Présentation</div>
  </div>
</div>
