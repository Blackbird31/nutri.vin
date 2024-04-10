<h1 data-liveform-name="domaine_nom" data-liveform-template='{{%s}}'><?php echo $qrcode->domaine_nom ?></h1>

<div class="row">
    <div class="col">
        <h3 class="fs-2 text-body-emphasis">Degré</h3>
        <p data-liveform-name="alcool_degre" data-liveform-template='{{%s}} %'><?php echo $qrcode->alcool_degre ?> %</p>
    </div>
    <div class="col">
        <h3 class="fs-2 text-body-emphasis">Centilisation</h3>
        <p data-liveform-name="centilisation" data-liveform-template='{{%s}} cl'><?php echo $qrcode->centilisation ?> cl</p>
    </div>
    <div class="col">
        <h3 class="fs-2 text-body-emphasis">Millésime</h3>
        <p data-liveform-name="millesime" data-liveform-template='{{%s}}°'><?php echo $qrcode->millesime ?></p>
    </div>
</div>

<img src="<?php echo $qrcode->etiquette ?>" class="img-thumbnail h-25">

