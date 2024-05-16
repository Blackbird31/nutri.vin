<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
  <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo '/qrcode/'.$qrcode->user_id.'/list'; ?>">Liste de vos QR Codes</a></li>
      <li class="breadcrumb-item active" aria-current="page">Création de votre QR Code</li>
  </ol>
</nav>

<h2>Création d'un vin</h2>

<div class="row justify-content-end">
  <div class="col-8">
      <form method="POST" action="/qrcode/<?php echo $qrcode->user_id ?>/write" enctype="multipart/form-data" class="live-form">
      <?php if (isset($qrcode->id)): ?>
          <input type="hidden" name="id" value="<?php echo $qrcode->id; ?>" />
      <?php endif; ?>


      <h3 class="mt-4 mb-4">Identité du commercialisant</h3>

      <div class="form-floating mb-3 col-sm-10">
          <input type="text" class="form-control" id="domaine_nom" name="domaine_nom" placeholder="Mon domaine" value="<?php echo $qrcode->domaine_nom; ?>"/>
          <label for="domaine_nom">Nom du Domaine</label>
      </div>
      <div class="form-floating mb-3 col-sm-10">
          <input type="text" class="form-control" id="adresse_domaine" name="adresse_domaine" placeholder="L'adresse de mon domaine" value="<?php echo $qrcode->adresse_domaine ;?>"/>
          <label for="adresse_domaine">Adresse du Domaine</label>
      </div>

      <h3 class="mt-4 mb-4">Information relative au vin</h3>


      <div class="form-floating mb-3 col-sm-10">
           <input type="text" class="form-control" id="cuvee_nom" name="cuvee_nom" placeholder="Ma cuvée" value="<?php echo $qrcode->cuvee_nom; ?>"/>
           <label for="cuvee_nom">Nom de la cuvée</label>
       </div>

       <div class="form-floating mb-3 col-sm-10">
           <input list="appellations_liste" type="text" class="form-control" id="appellation" name="appellation" value="<?php echo $qrcode->appellation; ?>" placeholder="Appellation"/>
            <datalist id="appellations_liste">
            <?php
              if (isset($config['appellations'])):
                foreach ($config['appellations'] as $appellation):
            ?>
              <option value="<?php echo $appellation ?>"></option>
            <?php
                endforeach;
              endif;
            ?>
            </datalist>
            <label form="appellation">Appellation</label>
       </div>

       <div class="d-flex col-sm-10 justify-content-between">

       <div class="form-floating col-sm-5">
           <input type="text" class="form-control" id="millesime" name="millesime" value="<?php echo $qrcode->millesime; ?>" placeholder="Millésime"/>
           <label form="millesime">Millésime</label>
       </div>

       <div class="form-floating col-sm-6">
           <input list="couleurs_liste" type="text" class="form-control" id="couleur" name="couleur" value="<?php echo $qrcode->couleur; ?>" placeholder="Rouge, Blanc, Rosé, ...."/>
            <datalist id="couleurs_liste">
            <?php
              if (isset($config['couleurs'])):
                foreach ($config['couleurs'] as $couleur):
            ?>
              <option value="<?php echo $couleur ?>"></option>
            <?php
                endforeach;
              endif;
            ?>
            </datalist>
           <label form="couleur">Couleur</label>
       </div>

       </div>

        <h3 class="mt-4 mb-4">Informations complémentaires</h3>
        <div class="d-flex col-sm-10 justify-content-between">
            <div class="col-sm-3">
                <div class="input-group mb-3">
                  <div class="form-floating">
                      <input type="text" class="form-control text-end input-float" id="alcool_degre" name="alcool_degre" placeholder="Volume d'alcool">
                      <label form="alcool_degre">Volume d'alcool</label>
                  </div>
                  <span class="input-group-text">%</span>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="input-group mb-3">
                  <div class="form-floating">
                      <input type="text" class="form-control text-end input-float" id="centilisation" name="centilisation" placeholder="Contenance">
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

        <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="ingredients_tableau_tab" data-bs-toggle="tab" data-bs-target="#ingredients_tableau" type="button" role="tab" aria-controls="ingredients_tableau" aria-selected="true">Liste</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="ingredients_texte_tab" data-bs-toggle="tab" data-bs-target="#ingredients_texte" type="button" role="tab" aria-controls="ingredients_texte" aria-selected="false">Texte</button>
          </li>
        </ul>

        <div class="tab-content py-4">
          <div class="tab-pane fade show active container col-sm-10 m-0 p-0" id="ingredients_tableau" role="tabpanel" aria-labelledby="ingredients_tableau" tabindex="0" data-liveform-ignore>
            <p id="message_ingredients_vide" class="d-none">Aucun ingredient n'a été saisi</p>
            <table id="table_ingredients" class="table table-sm col-sm-10 table-striped">
                  <thead>
                    <tr>
                      <th class="col-4" scope="col"></th>
                      <th class="col-1 text-center" scope="col">Bio</th>
                      <th class="col-1 text-center" scope="col">Allergène</th>
                    </tr>
                  </thead>
                  <tbody></tbody>
            </table>
            <template id="ingredient_row">
                <tr>
                    <td class="ingredient_libelle" scope="row"><div class="input-group"><span class="input-group-text" style="cursor: grab;" draggable="true"><i class="bi bi-grip-vertical"></i></span><input type="text" class="form-control" list="ingredients_list"></div></td>
                    <td class="ingredient_ab text-center align-middle">
                        <input class="form-check-input" type="checkbox" value="" aria-label="case à cocher pour ingrédient bio">
                    </td>
                    <td class="ingredient_allergene text-center align-middle">
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
          <div class="tab-pane fade col-sm-10 m-0 p-0" id="ingredients_texte" role="tabpanel" aria-labelledby="ingredients_texte" tabindex="0">
              <textarea class="form-control" rows="8" name="ingredients" id="ingredients"><?php echo $qrcode->ingredients ?></textarea>
          </div>
        </div>

      <h3 class="mt-4 mb-4">Informations nutritionelles</h3>

        <div class="form-floating mb-3 col-sm-10">
          <table class="table table-sm table-striped">
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

        <div class="mb-3 imgs-list">
            <div class="col-sm-10 row">
                <div class="col-sm-4 img_selector">
                    <center>
                        Bouteille
                        <img id="img_image_bouteille" src="<?php echo $qrcode->image_bouteille ?>" class="mb-2 img-preview img-thumbnail"/>
                        <span class="img-add btn btn-sm">
                            <?php if (strpos($qrcode->image_bouteille ?? '', 'data:') === false): ?>Ajouter<?php else: ?>Modifier<?php endif; ?>
                        </span>
                        <span style="<?php if (strpos($qrcode->image_bouteille ?? '', 'data:') === false) { echo 'display: none;'; }?>">
                            - <a class="btn btn-sm" href="/qrcode/<?php echo $qrcode->user_id ?>/edit/<?php echo $qrcode->id; ?>/img/0/delete">Supprimer</a>
                        </span>
                    </center>
                    <input type="file" class="d-none form-control" id="image_bouteille" name="image_bouteille" data-imageorigin="img_image_bouteille" value="<?php echo $qrcode->image_bouteille; ?>"/>
                </div>
                <div class="col-sm-4 img_selector">
                    <center>
                        Etiquette<br/>
                        <img id="img_image_etiquette" src="<?php echo $qrcode->image_etiquette ?>" class="mb-2 img-preview img-thumbnail"/>
                        <span class="img-add btn btn-sm">
                            <?php if (strpos($qrcode->image_etiquette ?? '', 'data:') === false): ?>Ajouter<?php else: ?>Modifier<?php endif; ?>
                        </span>
                        <span style="<?php if (strpos($qrcode->image_etiquette ?? '', 'data:') === false) { echo 'display: none;'; }?>">
                            - <a class="btn btn-sm" href="/qrcode/<?php echo $qrcode->user_id ?>/edit/<?php echo $qrcode->id; ?>/img/1/delete">Supprimer</a>
                        </span>
                    </center>
                    <input type="file" class="d-none form-control" id="image_etiquette" name="image_etiquette" data-imageorigin="img_image_etiquette" value="<?php echo $qrcode->image_etiquette; ?>"/>
                </div>
                <div class="col-sm-4 img_selector">
                    <center>
                        Contre-étiquette<br/>
                        <img id="img_image_contreetiquette" src="<?php echo $qrcode->image_contreetiquette ?>" class="mb-2 img-preview img-thumbnail"/>
                        <span class="img-add btn btn-sm">
                            <?php if (strpos($qrcode->image_contreetiquette ?? '', 'data:') === false): ?>Ajouter<?php else: ?>Modifier<?php endif; ?>
                        </span>
                        <span style="<?php if (strpos($qrcode->image_contreetiquette ?? '', 'data:') === false) { echo 'display: none;'; }?>">
                            - <a class="btn btn-sm" href="/qrcode/<?php echo $qrcode->user_id ?>/edit/<?php echo $qrcode->id; ?>/img/2/delete">Supprimer</a>
                        </span>
                    </center>
                    <input type="file" class="d-none form-control" id="image_contreetiquette" name="image_contreetiquette" data-imageorigin="img_image_contreetiquette" value="<?php echo $qrcode->image_contreetiquette; ?>"/>
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
                <a href="/qrcode/<?php echo $qrcode->user_id ?>/list" class="btn btn-light">Retour à la liste</a>
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
    <?php $iframe=false; ?>
    <?php include('_phone.html.php') ?>
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
            let ingredientsListe = (el.value).replace(/_(.*?)_/g, "<strong>$1</strong>");
            toUpdate.innerHTML = toUpdate.dataset.liveformTemplate.replace('{{%s}}', ingredientsListe)
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

    document.querySelector('.imgs-list').addEventListener('click', function (e) {
        const el = e.target
        const container = el.closest('.img_selector')
        const img = container.querySelector('img')
        const input = document.querySelector("input[type=file]#"+img.id.replace('img_', ''))

        if (el.classList.contains('img-add') || el.classList.contains('img-preview')) {
            input.click()
        }
    })

    document.querySelector('.input-float').addEventListener('change', function() {
        let valeur = this.value;
        valeur = valeur.replace(/,/g, '.');
        valeur = parseFloat(valeur).toFixed(2);
        this.value = valeur;
    });

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

    let ingredients = ingredientsText.split(/,(?![^()]*\))/);
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
