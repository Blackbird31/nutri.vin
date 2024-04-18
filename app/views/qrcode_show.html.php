
<div class="p-3 py-4 bg-white text-center liveform_anchor">
    <div class="bg-white border rounded rounded-bottom-0 shadow-sm">
        <img class="mt-3 bg-white border-bottom" style="height: 200px;"
            data-liveform-name="etiquette" data-liveform-template="{{%s}}"
            src="<?php echo $qrcode->etiquette ?>" >
    </div>
    <div class="bg-light-subtle border border-top-0 rounded rounded-top-0 pt-3 shadow-sm">
        <p data-liveform-name="domaine_nom" data-liveform-template='{{%s}}'
           class="fs-4"><?php echo $qrcode->domaine_nom ?></p>
        <p class="fs-3">
            <span data-liveform-name="cuvee_nom" data-liveform-template='{{%s}}'>
                <?php echo $qrcode->cuvee_nom ?>
            </span><br/>
            <small class="fw-light text-muted"
                data-liveform-name="appellation" data-liveform-template='{{%s}}'
            >
                <?php echo $qrcode->appellation ?>
            </small>
            <small class="fw-light text-muted"
                data-liveform-name="couleur" data-liveform-template='{{%s}}'
            >
                <?php echo $qrcode->couleur ?>
            </small>
        </p>
        <p class="fs-4"
           data-liveform-name="millesime" data-liveform-template='{{%s}}'
        >
            <?php echo $qrcode->millesime ?>
        </p>
    </div>
</div>

<div class="p-3 bg-light-subtle border-top liveform_anchor">
    <div class="card text-bg-light mt-2 mb-4 shadow-sm">
        <div class="card-header text-center"><i class="bi bi-info-circle float-start"></i> Informations complémentaires</div>
        <table class="table table-sm table-striped-columns mb-0">
            <tbody>
                <tr>
                    <td class="text-start">Contenance</td>
                    <td class="text-end"
                        data-liveform-name="centilisation" data-liveform-template='{{%s}} cl'>
                            <?php echo $qrcode->centilisation ?> cl</td>
                </tr>
                <tr>
                    <td class="text-start">Volume d'alcool</td>
                    <td class="text-end"
                        data-liveform-name="alcool_degre" data-liveform-template='{{%s}} % vol'
                    ><?php echo $qrcode->alcool_degre ?>% vol</td>
                </tr>
                <tr>
                    <td class="text-start">N° de lot</td>
                    <td class="text-end"
                        data-liveform-name="lot" data-liveform-template='{{%s}}'>
                            <?php echo $qrcode->lot ?></td>
                </tr>
            </tbody>
        </table>
    </div>
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
                <tr>
                    <td class="text-start">Énergie</td>
                    <td class="text-end">
                        <span data-liveform-name="nutritionnel_energie_kj" data-liveform-template='{{%s}} kJ'>
                            <?php echo $qrcode->nutritionnel_energie_kj ?: 0 ?> kJ
                        </span>
                        <br>
                        <span data-liveform-name="nutritionnel_energie_kcal" data-liveform-template='{{%s}} kCal'>
                            <?php echo $qrcode->nutritionnel_energie_kcal ?: 0 ?> kCal
                        </span><br>
                    </td>
                </tr>
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
                <tr>
                    <td class="text-start">Fibres alimentaires</td>
                    <td class="text-end">
                        <span data-liveform-name="nutritionnel_fibres" data-liveform-template='{{%s}} g'>
                            <?php echo $qrcode->nutritionnel_fibres ?: 0.00 ?> g
                        </span>
                    </td>
                </tr>
                <tr>
                    <td class="text-start">Protéines</td>
                    <td class="text-end">
                        <span data-liveform-name="nutritionnel_proteines" data-liveform-template='{{%s}} g'>
                            <?php echo $qrcode->nutritionnel_proteines ?: 0.00 ?> g
                        </span>
                    </td>
                </tr>
                <tr>
                    <td class="text-start">Sel</td>
                    <td class="text-end">
                        <span data-liveform-name="nutritionnel_sel" data-liveform-template='{{%s}} g'>
                            <?php echo $qrcode->nutritionnel_sel ?: 0.00 ?> g
                        </span>
                    </td>
                </tr>
                <tr>
                    <td class="text-start">Sodium</td>
                    <td class="text-end">
                        <span data-liveform-name="nutritionnel_sodium" data-liveform-template='{{%s}} g'>
                            <?php echo $qrcode->nutritionnel_sodium ?: 0.00 ?> g
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</div>
