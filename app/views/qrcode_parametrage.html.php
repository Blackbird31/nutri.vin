
<div class="row justify-content-end">
    <div class="col-8">
        <div class="d-flex justify-content-center">
            <img src="<?php echo $urlbase.'/'.$qrcode->id.'/svg'; ?>" class="img-thumbnail" style="height: 350px; width: 350px;">
        </div>
    </div>
    <div class="col-4">
        <?php $iframe = true; ?>
        <?php include('_phone.html.php') ?>
    </div>
</div>
