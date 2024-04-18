<h2>Création d'un vin</h2>

<div class="row justify-content-end">
  <div class="col-8">
      <form method="POST" action="<?php echo $urlbase; ?>/qrcode/<?php echo $qrcode->user_id; ?>/write" enctype="multipart/form-data" class="live-form">
      <?php if (isset($qrcode->id)): ?>
          <input type="hidden" name="id" value="<?php echo $qrcode->id; ?>" />
      <?php endif; ?>


      <h3 class="mt-4 mb-4">Identité du commercialisant</h3>

      <div class="form-floating mb-3 col-sm-10">
          <input type="text" class="form-control" id="domaine_nom" name="domaine_nom" placeholder="Mon domaine" value="<?php echo $qrcode->domaine_nom; ?>"/>
          <label for="domaine_nom">Nom du Domaine</label>
      </div>


      <h3 class="mt-4 mb-4">Information relative au vin</h3>


      <div class="form-floating mb-3 col-sm-10">
           <input type="text" class="form-control" id="cuvee_nom" name="cuvee_nom" placeholder="Ma cuvée" value="<?php echo $qrcode->cuvee_nom; ?>"/>
           <label for="cuvee_nom">Nom de la cuvée</label>
       </div>

       <div class="form-floating mb-3 col-sm-10">
           <input type="text" class="form-control" id="appellation" name="appellation" value="<?php echo $qrcode->appellation; ?>" placeholder="Appellation"/>
           <label form="appellation">Appellation</label>
       </div>

       <div class="d-flex col-sm-10 justify-content-between">

       <div class="form-floating mb-3 col-sm-5">
           <input type="text" class="form-control" id="millesime" name="millesime" value="<?php echo $qrcode->millesime; ?>" placeholder="Millésime"/>
           <label form="millesime">Millésime</label>
       </div>

       <div class="form-floating mb-3 col-sm-6">
           <input type="text" class="form-control" id="couleur" name="couleur" value="<?php echo $qrcode->couleur; ?>" placeholder="Rouge, Blanc, Rosé, ...."/>
           <label form="couleur">Couleur</label>
       </div>

       </div>

        <h3 class="mt-4 mb-4">Informations complémentaires</h3>
        <div class="d-flex col-sm-10 justify-content-between">
            <div class="col-sm-3">
                <div class="input-group mb-3">
                  <div class="form-floating">
                      <input type="text" class="form-control text-end" id="alcool_degre" name="alcool_degre" placeholder="Volume d'alcool">
                      <label form="alcool_degre">Volume d'alcool</label>
                  </div>
                  <span class="input-group-text">%</span>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="input-group mb-3">
                  <div class="form-floating">
                      <input type="text" class="form-control text-end" id="centilisation" name="centilisation" placeholder="Contenance">
                      <label form="centilisation">Contenance</label>
                  </div>
                  <span class="input-group-text">cl</span>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="input-group mb-3">
                  <div class="form-floating">
                      <input type="text" class="form-control" id="lot" name="lot" placeholder="Numéro de lot">
                      <label form="lot">Numéro de lot</label>
                  </div>
                </div>
            </div>
        </div>

        <h3 class="mt-4 mb-4">Liste des ingrédients</h3>

        <div class="mb-3 col-sm-10">
          <input type="hidden" class="form-control" name="ingredients" id="ingredients" value="<?php echo $qrcode->ingredients ?>" />
        </div>

        <div class="container col-sm-10 m-0 p-0" data-liveform-ignore>
        <p id="message_ingredients_vide" class="d-none">Aucun ingredient n'a été saisi</p>
        <table id="table_ingredients" class="table col-sm-10 table-striped">
              <thead>
                <tr>
                  <th class="col-4" scope="col"></th>
                  <th class="col-1 text-center" scope="col">AB</th>
                  <th class="col-1 text-center" scope="col">Allergène</th>
                </tr>
              </thead>
              <tbody></tbody>
        </table>
        <template id="ingredient_row">
            <tr>
                <td class="ingredient_libelle" scope="row"><div class="input-group"><span class="input-group-text" style="cursor: grab;" draggable="true"><i class="bi bi-grip-vertical"></i></span><input type="text" class="form-control" list="ingredients_list"></div></td>
                <td class="ingredient_ab text-center">
                    <input class="form-check-input" type="checkbox" value="" aria-label="case à cocher pour ingrédient bio">
                </td>
                <td class="ingredient_allergene text-center">
                    <input class="form-check-input" type="checkbox" value="" aria-label="case à cocher pour ingrédient allergène">
                </td>
            </tr>
        </template>
        <div class="input-group">
            <div class="col-sm-12">
                <div class="input-group">
                  <div class="form-floating">
                      <input list="ingredients_list" form="form_add_ingredients" id="text_add_ingredient" type="text" class="form-control" placeholder="Ingrédient(s)" aria-label="Ingrédient(s)" aria-describedby="btn_add_ingredient">
                      <label form="lot">Ingrédient(s)</label>
                  </div>
                  <button form="form_add_ingredients" class="btn btn-secondary" type="submit" id="btn_add_ingredient"><i class="bi bi-plus-circle"></i> Ajouter</button>
                </div>
            </div>
            <datalist id="ingredients_list">
                <?php foreach(QRCode::getFullListeIngredients() as $ingredient): ?>
                <option value="<?php echo $ingredient ?>"></option>
                <?php endforeach; ?>
            </datalist>
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

        <h3 class="mt-4 mb-4" id="photos">Photos</h3>

        <div class="mb-3">
            <div class="col-sm-10 row">
                <div class="col-sm-4">
                    <center>
                        Bouteille<br/>
                        <img id="img_image_bouteille" src="<?php echo $qrcode->image_bouteille ?>" class="img-thumbnail" style="height: 200px;"/><br/>
                        <a href="#" onClick='document.getElementById("image_bouteille").click(); return false;'>Editer</a>
                        <span style="<?php if (strpos($qrcode->image_bouteille, 'data:') === false) { echo 'display: none;'; }?>">
                            - <a href="./<?php echo $qrcode->id; ?>/img/0/delete">Supprimer</a>
                        </span>
                    </center>
                    <div style="display: none;">
                        <input type="file" class="form-control" id="image_bouteille" name="image_bouteille" data-imageorigin="img_image_bouteille" value="<?php echo $qrcode->image_bouteille; ?>"/>
                    </div>
                </div>
                <div class="col-sm-4">
                    <center>
                        Etiquette<br/>
                        <img id="img_image_etiquette" src="<?php echo $qrcode->image_etiquette ?>" class="img-thumbnail" style="height: 200px;"/><br/>
                        <a href="#" onClick='document.getElementById("image_etiquette").click(); return false;'>Editer</a>
                        <span style="<?php if (strpos($qrcode->image_etiquette, 'data:') === false) { echo 'display: none;'; }?>">
                            - <a href="./<?php echo $qrcode->id; ?>/img/1/delete">Supprimer</a>
                        </span>
                    </center>
                    <div style="display: none;">
                        <input type="file" class="form-control" id="image_etiquette" name="image_etiquette" data-imageorigin="img_image_etiquette" value="<?php echo $qrcode->image_etiquette; ?>"/>
                    </div>
                </div>
                <div class="col-sm-4">
                    <center>
                        Contre-étiquette<br/>
                        <img id="img_image_contreetiquette" src="<?php echo $qrcode->image_contreetiquette ?>" class="img-thumbnail" style="height: 200px;"/><br/>
                        <a href="#" onClick='document.getElementById("image_contreetiquette").click(); return false;'>Editer</a>
                        <span style="<?php if (strpos($qrcode->image_contreetiquette, 'data:') === false) { echo 'display: none;'; }?>">
                            - <a href="./<?php echo $qrcode->id; ?>/img/2/delete">Supprimer</a>
                        </span>
                    </center>
                    <div style="display: none;">
                        <input type="file" class="form-control" id="image_contreetiquette" name="image_contreetiquette" data-imageorigin="img_image_contreetiquette" value="<?php echo $qrcode->image_contreetiquette; ?>"/>
                    </div>
                </div>
            </div>
        </div>

        <h3 class="mt-4 mb-4">Autres informations destinées aux consommateurs</h3>

        <div class="mb-3 col-sm-10">
            <textarea class="form-control" name="autres_infos" rows="5"><?php echo $qrcode->autres_infos; ?></textarea>
            <div class="form-text">
              Les informations indiquée ici ne doivent être ni commerciales, ni marketing.
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-6">
                <a href="<?php echo $urlbase.'/qrcode/'.$qrcode->user_id .'/list'; ?>" class="btn btn-light">Retour à la liste</a>
            </div>
            <div class="col-4 text-end">
                <?php if ($qrcode->exists('authorization_key')): ?>
                <input type="hidden" name="authorization_key" value="<?php echo $qrcode->authorization_key; ?>"/>
                <?php endif; ?>
                <button type="submit" class="btn btn-primary">Valider</button>
            </div>
        </div>
      </form>
      <form id="form_add_ingredients"></form>
  </div>
  <div class="col-4 position-relative">
    <div class="border border-light-subtle border-4 py-5 px-2 bg-light rounded-5 shadow-sm bg-gradient position-fixed" style="margin-top: -2.5rem;">
        <div class="rounded-5 border border-2 bg-white border-light-subtle position-absolute top-0 start-50 translate-middle-x" style="width: 100px; height: 20px; margin-top: 15px;"></div>
        <div class="rounded-5 border border-2 bg-white border-light-subtle position-absolute top-0 end-0 mt-3 me-5" style="width: 20px; height: 20px;"></div>
        <div class="border border-light-subtle overflow-auto" style="height: 70vh; width: 400px;" data-liveform-container>
          <?php include('qrcode_show.html.php'); ?>
        </div>
        <div class="rounded-3 border border-2 bg-white border-light-subtle position-absolute bottom-0 start-50 translate-middle-x mb-1" style="width: 40px; height: 40px;"></div>
    </div>
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
        if (el.closest('[data-liveform-ignore]')) {
            return false;
        }

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
                document.getElementById(el.dataset.imageorigin).src = event.target.result;
            });
            reader.readAsDataURL(file);
        } else {
            toUpdate.innerHTML = toUpdate.dataset.liveformTemplate.replace('{{%s}}', el.value)
        }
        const blockAnchor = toUpdate.closest('.liveform_anchor')
        _template.scrollTop = blockAnchor.offsetTop - ((_template.offsetHeight - blockAnchor.offsetHeight) / 2)
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

    document.querySelector('#table_ingredients').addEventListener('dragstart', function (e) {
        const row = e.target.closest('tr');
        e.dataTransfer.addElement(row);
        e.dataTransfer.setData('indexOf', Array.from(document.querySelector('#table_ingredients tbody').children).indexOf(row))
    });

    document.querySelector('#table_ingredients').addEventListener('dragend', function (e) {
        console.log(e);
        console.log(e.dataTransfer.getData('indexOf'));
        const rowOriginal = Array.from(document.querySelector('#table_ingredients tbody').children)[e.dataTransfer.getData('indexOf')];

        document.querySelector('#table_ingredients tbody').appendChild(rowOriginal);
        //rowOriginal.remove();
    });
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
        templateClone.querySelector('td.ingredient_libelle input').value = ingredient.replace(/[_\*]/g, '');
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
        let ingredient = item.querySelector('td.ingredient_libelle input').value;
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
