<h2>Création d'un vin</h2>

<div class="row justify-content-end">
  <div class="col-8">
      <form method="POST" action="<?php echo $urlbase; ?>/qrcode/<?php echo $qrcode->user_id; ?>/write" enctype="multipart/form-data" class="live-form">
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

       <div class="form-floating mb-3 col-sm-2">
           <input type="text" class="form-control" id="millesime" name="millesime" value="<?php echo $qrcode->millesime; ?>" placeholder="Millésime"/>
           <label form="millesime" class="form-label">Millésime</label>
       </div>


        <h3 class="mt-4 mb-4">Informations complémentaires</h3>

        <div class="d-flex col-sm-10 justify-content-between">

        <div class="mb-3 col-sm-3">
          <label form="couleur" class="col-form-label">Couleur</label>
            <input type="text" class="form-control" id="couleur" name="couleur" value="<?php echo $qrcode->couleur; ?>" placeholder="Rouge, Blanc, Rosé, ...."/>
        </div>

        <div class="mb-3 col-sm-3">
            <label form="alcool_degre" class="col-form-label">Volume d'alcool</label>
              <div class="input-group">
                <input type="text" class="form-control text-sm-end" id="alcool_degre" name="alcool_degre" value="<?php echo $qrcode->alcool_degre; ?>" placeholder="Dégré d'alcool"/>
                <span class="input-group-text" id="basic-addon2">%</span>
              </div>
        </div>

        <div class="mb-3 col-sm-3">
            <label form="quantite" class="col-form-label">Contenance</label>
            <div class="input-group">
                <input type="text" class="form-control text-sm-end" id="centilisation" name="centilisation" value="<?php echo $qrcode->centilisation; ?>" placeholder="Centilisation"/>
                <span class="input-group-text" id="basic-addon2">cl</span>
            </div>
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

        <div class="mb-3 col-sm-10">
          <input type="hidden" class="form-control" name="ingredients" id="ingredients" value="<?php echo $qrcode->ingredients ?>" />
        </div>

        <div class="container col-sm-10 m-0 p-0" >
        <p id="message_ingredients_vide" class="d-none">Aucun ingredient n'a été saisi</p>
        <table id="table_ingredients" class="table col-sm-10 table-striped">
              <thead>
                <tr>
                  <th class="col-4" scope="col"></th>
                  <th class="col-1 text-center" scope="col">AB</th>
                  <th class="col-1 text-center" scope="col">Allergène</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                    <td class="text-center text-muted" colspan="3">Aucun ingrédient</td>
                </tr>
              </tbody>
        </table>
        <template id="ingredient_row">
            <tr>
                <td class="ingredient_libelle" scope="row"></td>
                <td class="ingredient_ab text-center">
                    <input class="form-check-input" type="checkbox" value="" aria-label="case à cocher pour ingrédient bio">
                </td>
                <td class="ingredient_allergene text-center">
                    <input class="form-check-input" type="checkbox" value="" aria-label="case à cocher pour ingrédient allergène">
                </td>
            </tr>
        </template>
        <div class="input-group">
            <input list="ingredients_list" form="form_add_ingredients" id="text_add_ingredient" type="text" class="form-control" placeholder="Ingrédient(s)" aria-label="Example text with button addon" aria-describedby="btn_add_ingredient">
            <datalist id="ingredients_list">
                <?php foreach(QRCode::getFullListeIngredients() as $ingredient): ?>
                <option value="<?php echo $ingredient ?>"></option>
                <?php endforeach; ?>
            </datalist>
            <button form="form_add_ingredients" class="btn btn-outline-secondary" type="submit" id="btn_add_ingredient"><i class="bi bi-plus-circle"></i> Ajouter</button>
        </div>
        <div class="form-text">
          Il est possible d'ajouter plusieurs ingrédients d'un coup en les séparant par une ","
        </div>
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
      <form id="form_add_ingredients"></form>
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

        _template.scrollTop = toUpdate.closest('.liveform_anchor').offsetTop
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

        if (e.target.closest('#table_ingredients')) {
            ingredientsTableToText();
        }
        if (e.target.closest(liveform.classe)) {
            liveform.update(e.target)
        }
    })
})

function ingredientsTextToTable() {
    const ingredientsText = document.getElementById('ingredients').value
    const ingredientsTbody = document.querySelector('table#table_ingredients tbody')
    ingredientsTbody.innerHTML = "";
    if(!ingredientsText) {
        document.querySelector('table#table_ingredients').classList.add('d-none');
        document.querySelector('#message_ingredients_vide').classList.remove('d-none');
        message_ingredients_vide
        return;
    }

    document.querySelector('#message_ingredients_vide').classList.add('d-none');
    document.querySelector('table#table_ingredients').classList.remove('d-none');

    let ingredients = ingredientsText.split(/[ ]*,[ ]*/)
    for(let ingredient of ingredients) {
        const templateClone = document.querySelector("#ingredient_row").content.cloneNode(true);
        templateClone.querySelector('td.ingredient_libelle').innerText = ingredient.replace(/[_\*]/g, '');
        if(ingredient.match(/\*$/)) {
            templateClone.querySelector('td.ingredient_ab input').checked = true
        }
        if(ingredient.match(/^_[^_]*_\*?$/)) {
            templateClone.querySelector('td.ingredient_allergene input').checked = true
        }
        ingredientsTbody.appendChild(templateClone);
    }
}

function ingredientsTableToText() {
    let ingredientsText = '';
    document.querySelector('table#table_ingredients tbody').querySelectorAll('tr').forEach(function(item) {
        if(ingredientsText) {
            ingredientsText += ', '
        }
        let ingredient = item.querySelector('td.ingredient_libelle').innerText;
        if(item.querySelector('td.ingredient_allergene input').checked) {
            ingredient = '_'+ingredient+'_'
        }
        if(item.querySelector('td.ingredient_ab input').checked) {
            ingredient += '*'
        }
        ingredientsText += ingredient;
    })
    document.getElementById('ingredients').value = ingredientsText;
    liveform.update(document.getElementById('ingredients'));
}

document.querySelector('#form_add_ingredients').addEventListener('submit', function(e) {
    e.preventDefault();
    const input_ingredients = document.querySelector('#ingredients');
    const text_add_ingredient = document.querySelector('#text_add_ingredient');

    text_add_ingredient.focus();
    if(!text_add_ingredient.value) {
        return;
    }

    if(input_ingredients.value) {
        input_ingredients.value += ', '
    }

    input_ingredients.value += text_add_ingredient.value;
    text_add_ingredient.value = "";
    ingredientsTextToTable();
    liveform.update(document.getElementById('ingredients'));
});

ingredientsTextToTable();

</script>
