<h2>Création d'un vin</h2>

<div class="row justify-content-end">
  <div class="col-8">
      <form method="POST" action="<?php echo $urlbase; ?>/qrcode/<?php echo $qrcode->user_id; ?>/write" enctype="multipart/form-data" class="live-form">
      <?php if (isset($qrcode->id)): ?>
          <input type="hidden" name="id" value="<?php echo $qrcode->id; ?>" />
      <?php endif; ?>


      <h3 class="mt-4 mb-4">Information commerciale</h3>

      <div class="form-floating mb-3 col-sm-10">
          <input autofocus="autofocus" type="text" class="form-control" id="domaine_nom" name="domaine_nom" placeholder="Mon domaine" value="<?php echo $qrcode->domaine_nom; ?>"/>
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

        <div class="d-flex col-sm-10 justify-content-between" >
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
        <?php if ($qrcode->ingredients): ?>
          <div class="form-floating mb-3 col-sm-10 collapse" id="textAreaIngredients" >
        <?php else: ?>
          <div class="form-floating mb-3 col-sm-10" id="textAreaIngredients" >
        <?php endif; ?>
            <select id="ingredientsBox" name="ingredients[]" multiple="multiple" class="form-select form-select-lg" data-placeholder="Liste des ingrédients">
              <?php foreach(QRCode::getFullListeIngredients() as $i):?>
                <option value="<?php echo htmlspecialchars($i); ?>"><?php echo htmlspecialchars($i); ?></option>
              <?php endforeach; ?>
            </select>
            <!-- <div id="ingredients_help" class="form-text">ingredients</div> -->
          </div>

        <?php if ($qrcode->ingredients): ?>
          <p>
            <button class="btn" type="button" data-bs-toggle="collapse" data-bs-target="#textAreaIngredients" aria-expanded="false" aria-controls="textAreaIngredients">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-square-fill" viewBox="0 0 16 16">
                <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm6.5 4.5v5.793l2.146-2.147a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L7.5 10.293V4.5a.5.5 0 0 1 1 0"/>
              </svg>
            </button>
          </p>
        <?php endif; ?>

        <?php if ($qrcode->ingredients): ?>
          <div class="container col-sm-10 m-0 p-0" >
            <table class="table table-bordered col-sm-10">
              <caption class="caption-top">Tableau des ingrédients</caption>
                  <thead class="table-dark text-center" >
                    <tr>
                      <th class="col-4" scope="col">Ingredient</th>
                      <th class="col-4" scope="col">Type</th>
                      <th class="col-1" scope="col">Bio</th>
                      <th class="col-1" scope="col">All.</th>
                    </tr>
                  </thead>
                  <?php $x = 0; foreach($qrcode->getListeIngredients() as $ingredient): $x++ ?>
                  <tbody>
                      <tr class="text-center" >
                        <th scope="row"> <?php echo htmlspecialchars($ingredient); ?></th>

                        <th>
                          <select name="detailIngredient" id="detailsIngredientSelect">
                            <?php foreach(QRCode::getFullListeIngredients() as $detailIngredient):?>
                              <option value="<?php echo htmlspecialchars($detailIngredient); ?>"><?php echo htmlspecialchars($detailIngredient); ?>
                            <?php endforeach; ?>
                              </option>

                          </select>
                        </th>

                        <th>
                          <input class="form-check-input" type="checkbox" id="checkboxBio" value="" aria-label="case à cocher pour ingrédient bio">
                        </th>
                        <th>
                        <input class="form-check-input" type="checkbox" id="checkboxAllergene" value="" aria-label="case à cocher pour ingrédient allergène">
                        </th>
                      </tr>
                  </tbody>
                  <?php endforeach; ?>

            </table>
            <figcaption class="figure-caption" >All. = Allergène</caption>
          </div>
        <?php endif; ?>

         <?php if ($qrcode->ingredients): ?>
        <p id="ingredientSelects">
            <?php $x = 0; foreach($qrcode->getListeIngredients() as $i): $x++?>
                <select name="ingredients_<?php echo $x; ?>">
                    <option value="<?php echo htmlspecialchars($i); ?>"><?php echo htmlspecialchars($i); ?></option>
                    <option value="<?php echo htmlspecialchars($i); ?> (bio)"><?php echo htmlspecialchars($i); ?> (bio)</option>
                </select>
            <?php endforeach; ?>
            <?php echo ',' . '&nbsp'; ?>
            <select id="newIngredientSelect" name="ingredients_<?php echo $x++; ?>" class="ingredientSelect">
                <option></option>
                <?php foreach(QRCode::getFullListeIngredients() as $i):?>
                    <option value="<?php echo htmlspecialchars($i); ?>"><?php echo htmlspecialchars($i); ?></option>
                <?php endforeach; ?>
            </select>
            <?php echo ',' . '&nbsp'; ?>
        </p>
        <?php endif; ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function addNewSelect() {
        var prevSelect = document.querySelector('.ingredientSelect');
        if (prevSelect) {
            prevSelect.removeEventListener('change', selectChangeHandler);
        }

        var newSelect = document.createElement('select');
        newSelect.name = 'ingredients_' + document.querySelectorAll('select[name^="ingredients_"]').length;
        newSelect.classList.add('ingredientSelect');

        var defaultOption = document.createElement('option');
        newSelect.appendChild(defaultOption);

        <?php foreach(QRCode::getFullListeIngredients() as $i): ?>
            var option = document.createElement('option');
            option.value = '<?php echo htmlspecialchars($i); ?>';
            option.textContent = '<?php echo htmlspecialchars($i); ?>';
            newSelect.appendChild(option);
        <?php endforeach; ?>

        document.getElementById('ingredientSelects').appendChild(newSelect);

        newSelect.addEventListener('change', selectChangeHandler);

        var newComma = document.createElement('span');
        newComma.textContent = ",";
        newComma.classList.add('pe-2');
        document.getElementById('ingredientSelects').appendChild(newComma);
    }

    function selectChangeHandler() {
        var selectedValue = this.value;
        if (selectedValue) {
            addNewSelect();
        }
    }

    var initialSelect = document.querySelector('.ingredientSelect');
    initialSelect.addEventListener('change', selectChangeHandler);
});
</script>

      <h3 class="mt-4 mb-4">Informations nutritionelles</h3>

        <div class="form-floating mb-3 col-sm-10">
          <table class="table table-striped">
            <tbody>


              <tr>
                <td class="align-middle">Énergie (kJ)</td>
                  <td>
                    <div class="col-6 offset-6">
                    <div class="input-group">
                      <input type="text" class="form-control text-sm-end" id="nutritionnel_energie_kj" name="nutritionnel_energie_kj" value="<?php echo $qrcode->nutritionnel_energie_kj; ?>"/>
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
                      <input type="text" class="form-control text-sm-end" id="nutritionnel_energie_kcal" name="nutritionnel_energie_kcal" value="<?php echo $qrcode->nutritionnel_energie_kcal; ?>"/>
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
  <div class="col-4 text-center border border-primary bg-primary-subtle sticky-top overflow-auto" style="height: 85vh" data-liveform-container>
    <h3>Prévisualisation</h3>
    <?php include('qrcode_show.html.php'); ?>
  </div>
</div>

<script>
const liveform = (function () {
    const _template = document.querySelector("[data-liveform-container]")
    const classe   = 'form.live-form'

    if (_template === null) {
        console.error('Pas de template')
        return false
    }

    function update(el) {
        const toUpdate = _template.querySelector("[data-liveform-name='"+el.name+"']")
        if (toUpdate === null) {
            console.error("Pas d'élément liveform avec l'attribut : "+el.name)
            return false;
        }

        if (el.type === 'file') {
            const file = el.files[0]
            if (!file.type) {
                status.textContent = 'Error: The File.type property does not appear to be supported on this browser.';
                return;
            }
            if (!file.type.match('image.*')) {
                status.textContent = 'Error: The selected file does not appear to be an image.'
                return;
            }
            const reader = new FileReader();
            reader.addEventListener('load', event => {
                toUpdate.src = event.target.result;
            });
            reader.readAsDataURL(file);
        } else {
            toUpdate.innerHTML = toUpdate.dataset.liveformTemplate.replace('{{%s}}', el.value)
        }

        _template.scrollTop = toUpdate.closest('div').offsetTop
    }

    return {
        classe: classe,
        update: update
    }
})();

document.addEventListener('DOMContentLoaded', function () {
    const ne_kcal = document.querySelector('#nutritionnel_energie_kcal')
    const ne_j    = document.querySelector('#nutritionnel_energie_kj')
    const conversion = 4.184

    document.addEventListener('change', function (e) {
        if (e.target.id.includes('nutritionnel_energie')) {
            const updated  = e.target
            const toUpdate = updated.id.includes('kcal') ? ne_j : ne_kcal;

            toUpdate.value = updated.id.includes('kcal') ? updated.value * conversion : updated.value / conversion;
            toUpdate.value = parseInt(toUpdate.value)
            liveform.update(toUpdate)
            e.stopPropagation()
        }

        if (e.target.closest(liveform.classe)) {
            liveform.update(e.target)
        }
    })
})
</script>
