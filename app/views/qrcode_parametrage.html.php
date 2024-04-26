<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
  <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo '/qrcode/'.$qrcode->user_id.'/list'; ?>">Liste de vos QR Codes</a></li>
      <li class="breadcrumb-item active" aria-current="page">Visualisation de votre QR Code</li>
  </ol>
</nav>

<div class="row">
    <div class="col-2">
        <a href="<?php echo $urlbase.'/qrcode/'.$qrcode->user_id .'/list'; ?>" class="btn btn-light">Retour à la liste</a>
    </div>
    <div class="col-8">
        <h1 class="text-center mb-4">Paramétrage de votre QR code</h1>
    </div>
</div>
<div class="row justify-content-end">
    <div class="col-8 mt-5">
        <div class="d-flex justify-content-center">
            <img src="<?php echo $urlbase.'/'.$qrcode->id.'/svg'; ?>" class="img-thumbnail" style="height: 350px; width: 350px;">
        </div>
        <form id="logoForm" method="POST" action="<?php echo $urlbase.'/qrcode/'.$qrcode->user_id.'/parametrage/'.$qrcode->id; ?>" enctype="multipart/form-data">
            <input type="checkbox" class="btn-check" id="btncheck1" name="logo" autocomplete="off" value="1" <?php if($qrcode->logo):?>checked<?php endif; ?>>
            <div class="d-flex justify-content-center">
                <label class="btn btn-outline-primary mt-5" for="btncheck1">Logo IVSO <?php if($qrcode->logo):?>activé<?php else:?>désactivé<?php endif; ?></label>
            </div>
            </form>
            <div class="row position-absolute top-100 start-40">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-download"></i> Formats de téléchargement
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" target="_blank" href="<?php echo $urlbase.'/'.$qrcode->id.'/pdf'; ?>">PDF</a></li>
                        <li><a class="dropdown-item" target="_blank" href="<?php echo $urlbase.'/'.$qrcode->id.'/svg'; ?>">SVG</a></li>
                        <li><a class="dropdown-item" href="<?php echo $urlbase.'/'.$qrcode->id.'/eps'; ?>">EPS</a></li>
                    </ul>
                </div>
            </div>
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
