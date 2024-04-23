<h1 class="text-center mb-4">Paramétrage de votre QR code</h1>
<div class="row justify-content-end">
    <div class="col-8 mt-5">
        <div class="d-flex justify-content-center">
            <img src="<?php echo $urlbase.'/'.$qrcode->id.'/svg'; ?>" class="img-thumbnail" style="height: 350px; width: 350px;">
        </div>
        <form id="logoForm" method="POST" action="<?php echo $urlbase.'/qrcode/'.$qrcode->user_id.'/parametrage/'.$qrcode->id; ?>" enctype="multipart/form-data">
            <input type="checkbox" class="btn-check" id="btncheck1" name="logo" autocomplete="off" value="1" <?php if($qrcode->logo):?>checked<?php endif; ?>>
            <label class="btn btn-outline-primary" for="btncheck1">Logo IVSO <?php if($qrcode->logo):?>activé<?php else:?>désactivé<?php endif; ?></label>
        </form>
    </div>
    <div class="col-4">
        <?php $iframe = true; ?>
        <?php include('_phone.html.php') ?>
    </div>
</div>

<script>
    var checkbox = document.getElementById('btncheck1');

    checkbox.addEventListener('click', function() {
            document.querySelector('input[name="logo"]').value = this.checked ? 1 : 0;
            document.getElementById('logoForm').submit();
    });
</script>
