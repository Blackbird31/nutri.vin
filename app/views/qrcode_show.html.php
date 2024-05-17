<div class="p-3 py-4 bg-white text-center liveform_anchor">

    <div id="carrousel" class="bg-white border rounded rounded-bottom-0 shadow-sm d-flex justify-content-center">
        <img id="slide_image_bouteille" class="mt-3 bg-white border-bottom" style="height: 200px;"
            data-liveform-name="image_bouteille" data-liveform-template="{{%s}}"
            src="<?php echo $qrcode->image_bouteille ?>" >
        <img id="slide_image_etiquette" class="mt-3 bg-white border-bottom" style="display: none; height: 200px;"
            data-liveform-name="image_etiquette" data-liveform-template="{{%s}}"
            src="<?php echo $qrcode->image_etiquette ?>" >
        <img id="slide_image_contreetiquette" class="mt-3 bg-white border-bottom" style="display: none; height: 200px;"
            data-liveform-name="image_contreetiquette" data-liveform-template="{{%s}}"
            src="<?php echo $qrcode->image_contreetiquette ?>" >
        <div class="position-absolute top-50 start-0" id="precedent" onClick="changeSlide(-1)">
            <i class="bi bi-chevron-compact-left"></i>
        </div>
        <div class="position-absolute top-50 start-90" id="suivant" onClick="changeSlide(1)">
            <i class="bi bi-chevron-compact-right"></i>
        </div>
    </div>

    <div class="bg-light-subtle border border-top-0 rounded rounded-top-0 pt-3 shadow-sm">
        <?php if (empty($publicview) || (!empty($publicview) && $qrcode->domaine_nom)): ?>
        <p data-liveform-name="domaine_nom" data-liveform-template='{{%s}}' class="fs-4">
          <?php echo $qrcode->domaine_nom ?>
        </p>
        <?php endif; ?>
        <?php if (empty($publicview) || (!empty($publicview) && ($qrcode->cuvee_nom || $qrcode->appellation || $qrcode->couleur))): ?>
        <p class="fs-3">
            <?php if (empty($publicview) || $qrcode->cuvee_nom): ?>
            <span data-liveform-name="cuvee_nom" data-liveform-template='{{%s}}'>
                <?php echo $qrcode->cuvee_nom ?>
            </span>
            <br/>
            <?php endif; ?>
            <?php if (empty($publicview) || $qrcode->appellation): ?>
            <small class="fw-light text-muted" data-liveform-name="appellation" data-liveform-template='{{%s}}'>
                <?php echo $qrcode->appellation ?>
            </small>
            <?php endif; ?>
            <?php if (empty($publicview) || $qrcode->appellation): ?>
            <small class="fw-light text-muted" data-liveform-name="couleur" data-liveform-template='{{%s}}'>
                <?php echo $qrcode->couleur ?>
            </small>
            <?php endif; ?>
        </p>
        <?php endif; ?>
        <?php if (empty($publicview) || (!empty($publicview) && $qrcode->millesime)): ?>
        <p class="fs-4" data-liveform-name="millesime" data-liveform-template='{{%s}}'>
            <?php echo $qrcode->millesime ?>
        </p>
        <?php endif; ?>
    </div>
</div>

<div class="px-3 pt-3 bg-light-subtle border-top ">
    <?php if(empty($publicview) || (!empty($publicview) && ($qrcode->alcool_degre || $qrcode->centilisation || $qrcode->lot))): ?>
    <div class="card text-bg-light mt-2 mb-4 shadow-sm liveform_anchor">
        <div class="card-header text-center"><i class="bi bi-info-circle float-start"></i> Informations complémentaires</div>
        <table class="table table-sm table-striped-columns mb-0">
            <tbody>
                <?php if (empty($publicview) || $qrcode->alcool_degre): ?>
                <tr>
                    <td class="text-start">Volume d'alcool</td>
                    <td class="text-end"
                        data-liveform-name="alcool_degre" data-liveform-template='{{%s}} % vol'
                    ><?php echo $qrcode->alcool_degre ?>% vol</td>
                </tr>
                <?php endif; ?>
                <?php if (empty($publicview) || $qrcode->centilisation): ?>
                <tr>
                    <td class="text-start">Contenance</td>
                    <td class="text-end"
                        data-liveform-name="centilisation" data-liveform-template='{{%s}} cl'>
                            <?php echo $qrcode->centilisation ?> cl</td>
                </tr>
                <?php endif; ?>
                <?php if (empty($publicview) || $qrcode->lot): ?>
                <tr>
                    <td class="text-start">N° de lot</td>
                    <td class="text-end"
                        data-liveform-name="lot" data-liveform-template='{{%s}}'>
                            <?php echo $qrcode->lot ?></td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>
    <?php if (empty($publicview) || (!empty($publicview) && $qrcode->ingredients)): ?>
    <div class="card text-bg-secondary mt-4 mb-3 shadow-sm liveform_anchor">
        <div class="card-header text-center"><i class="bi bi-card-list float-start"></i> Ingrédients</div>
        <div class="card-body text-dark bg-white">
            <p data-liveform-name="ingredients" data-liveform-template='{{%s}}'
                class="card-text">
                <?php echo $qrcode->ingredients ?>
            </p>
            <small>
                Ingrédients allergènes indiqués en <strong>gras</strong>.<br/>
                Ingrédients issus de l'agriculture biologique indiqué avec une <em>*</em>
            </small>
        </div>
    </div>
    <?php endif; ?>
    <?php if (
            empty($publicview) ||
            (!empty($publicview) && ($qrcode->nutritionnel_energie_kj || $qrcode->nutritionnel_energie_kj === 0)) ||
            (!empty($publicview) && ($qrcode->nutritionnel_energie_kcal || $qrcode->nutritionnel_energie_kcal === 0)) ||
            (!empty($publicview) && ($qrcode->nutritionnel_graisses || $qrcode->nutritionnel_graisses === 0)) ||
            (!empty($publicview) && ($qrcode->nutritionnel_glucides || $qrcode->nutritionnel_glucides === 0)) ||
            (!empty($publicview) && ($qrcode->nutritionnel_fibres || $qrcode->nutritionnel_fibres === 0)) ||
            (!empty($publicview) && ($qrcode->nutritionnel_proteines || $qrcode->nutritionnel_proteines === 0)) ||
            (!empty($publicview) && ($qrcode->nutritionnel_sel || $qrcode->nutritionnel_sel === 0)) ||
            (!empty($publicview) && ($qrcode->nutritionnel_sodium || $qrcode->nutritionnel_sodium === 0))
          ):
    ?>
    <div class="card text-bg-primary mt-4 mb-2 shadow-sm liveform_anchor">
        <div class="card-header text-center"><i class="bi bi-clipboard-data float-start"></i> Informations nutritionnelles</div>
        <table class="table table-sm table-striped-columns mb-0">
            <thead>
                <tr>
                    <th class="text-start col-6">Type</th>
                    <th class="text-end col-6">Pour 100 mL</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($publicview) || (!empty($publicview) && ($qrcode->nutritionnel_energie_kj || $qrcode->nutritionnel_energie_kj === 0)) || (!empty($publicview) && ($qrcode->nutritionnel_energie_kcal || $qrcode->nutritionnel_energie_kcal === 0))): ?>
                <tr>
                    <td class="text-start">Énergie</td>
                    <td class="text-end">
                        <?php if (empty($publicview) || (!empty($publicview) && ($qrcode->nutritionnel_energie_kj || $qrcode->nutritionnel_energie_kj === 0))): ?>
                        <span data-liveform-name="nutritionnel_energie_kj" data-liveform-template='{{%s}} kJ'>
                            <?php echo $qrcode->nutritionnel_energie_kj ?: 0 ?> kJ
                        </span>
                        <br>
                        <?php endif; ?>
                        <?php if (empty($publicview) || (!empty($publicview) && ($qrcode->nutritionnel_energie_kcal || $qrcode->nutritionnel_energie_kcal === 0))): ?>
                        <span data-liveform-name="nutritionnel_energie_kcal" data-liveform-template='{{%s}} kCal'>
                            <?php echo $qrcode->nutritionnel_energie_kcal ?: 0 ?> kCal
                        </span><br>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endif; ?>
                <?php if (empty($publicview) || (!empty($publicview) && ($qrcode->nutritionnel_graisses || $qrcode->nutritionnel_graisses === 0))): ?>
                <tr>
                    <td class="text-start">Matières grasses<br><small class="ps-3">dont acides gras saturés</small></td>
                    <td class="text-end">
                        <span data-liveform-name="nutritionnel_graisses" data-liveform-template='{{%s}} g'>
                            <?php echo $qrcode->nutritionnel_graisses ?: 0.00 ?> g
                        </span>
                        <br>
                        <small>
                        <span data-liveform-name="nutritionnel_acides_gras" data-liveform-template='{{%s}} g'>
                            <?php echo $qrcode->nutritionnel_acides_gras ?: 0.00 ?> g
                        </span>
                        </small>
                    </td>
                </tr>
                <?php endif; ?>
                <?php if (empty($publicview) || (!empty($publicview) && ($qrcode->nutritionnel_glucides || $qrcode->nutritionnel_glucides === 0))): ?>
                <tr>
                    <td class="text-start">Glucides<br><small class="ps-3">dont sucres</small></td>
                    <td class="text-end">
                        <span data-liveform-name="nutritionnel_glucides" data-liveform-template='{{%s}} g'>
                            <?php echo $qrcode->nutritionnel_glucides ?: 0.00 ?> g
                        </span>
                        <br>
                        <small>
                        <span data-liveform-name="nutritionnel_sucres" data-liveform-template='{{%s}} g'>
                            <?php echo $qrcode->nutritionnel_sucres ?: 0.00 ?> g
                        </span>
                        </small>
                    </td>
                </tr>
                <?php endif; ?>
                <?php if (empty($publicview) || (!empty($publicview) && ($qrcode->nutritionnel_fibres || $qrcode->nutritionnel_fibres === 0))): ?>
                <tr>
                    <td class="text-start">Fibres alimentaires</td>
                    <td class="text-end">
                        <span data-liveform-name="nutritionnel_fibres" data-liveform-template='{{%s}} g'>
                            <?php echo $qrcode->nutritionnel_fibres ?: 0.00 ?> g
                        </span>
                    </td>
                </tr>
                <?php endif; ?>
                <?php if (empty($publicview) || (!empty($publicview) && ($qrcode->nutritionnel_proteines || $qrcode->nutritionnel_proteines === 0))): ?>
                <tr>
                    <td class="text-start">Protéines</td>
                    <td class="text-end">
                        <span data-liveform-name="nutritionnel_proteines" data-liveform-template='{{%s}} g'>
                            <?php echo $qrcode->nutritionnel_proteines ?: 0.00 ?> g
                        </span>
                    </td>
                </tr>
                <?php endif; ?>
                <?php if (empty($publicview) || (!empty($publicview) && ($qrcode->nutritionnel_sel || $qrcode->nutritionnel_sel === 0))): ?>
                <tr>
                    <td class="text-start">Sel</td>
                    <td class="text-end">
                        <span data-liveform-name="nutritionnel_sel" data-liveform-template='{{%s}} g'>
                            <?php echo $qrcode->nutritionnel_sel ?: 0.00 ?> g
                        </span>
                    </td>
                </tr>
                <?php endif; ?>
                <?php if (empty($publicview) || (!empty($publicview) && ($qrcode->nutritionnel_sodium || $qrcode->nutritionnel_sodium === 0))): ?>
                <tr>
                    <td class="text-start">Sodium</td>
                    <td class="text-end">
                        <span data-liveform-name="nutritionnel_sodium" data-liveform-template='{{%s}} g'>
                            <?php echo $qrcode->nutritionnel_sodium ?: 0.00 ?> g
                        </span>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>

    <?php if (!empty($qrcode->autres_infos)): ?>
    <div class="card text-bg-Light mt-4 mb-1 shadow-sm liveform_anchor">
        <div class="card-header text-center"><i class="bi bi-clipboard-data float-start"></i>Autres informations</div>
        <p class="pt-2 px-2"
           data-liveform-name="autres_infos" data-liveform-template='{{%s}}'
        >
            <?php echo $qrcode->autres_infos ?>
        </p>
    </div>
    <?php endif; ?>

    <div class="mb-1 small text-center">
      <?php $nbVue = count($qrcode->getVisites()); ?>
      <i class="bi bi-eye text-muted" title="<?php echo $nbVue; ?> vue<?php if ($nbVue > 1): ?>s<?php endif; ?>" style="cursor: pointer;"></i>
    </div>

</div>

<script>
    const slide = ["image_bouteille", "image_etiquette", "image_contreetiquette"];

    let numero = 0;

    function changeSlide(sens) {
        orig = numero
        numero += sens;
        if (numero < 0) {
            numero = slide.length - 1;
        }
        if (numero > slide.length - 1) {
            numero = 0;
        }
        document.getElementById("slide_"+slide[orig]).style.display = 'none'
        document.getElementById("slide_"+slide[numero]).style.display = 'block'
    }

</script>
