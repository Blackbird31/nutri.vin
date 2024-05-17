<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Liste de vos QR Codes</li>
    </ol>
</nav>

<h2 class="text-center"><?php echo $userid;?> QR Codes</h2>

<h3 class="mt-4 ">Liste des QR code</h3>
<div class="text-end row">
    <form id="multiExportForm" method="GET" action="/qrcode/<?php echo $userid ?>/multiexport" enctype="multipart/form-data">
        <div class="col">
            <?php if ($qrlist): ?>
                <button type="submit" id="multiExportBtn" class="btn btn-primary mb-2" disabled>Télécharger la sélection</button>
            <?php endif; ?>
        </div>
    </form>
    <table id="list_qr" class="table table-bordered table-striped text-center">
        <thead>
            <tr>
                <th class="col-1"><input id="allCheck" type="checkbox"></input></th>
                <th class="col-3">Nom commercial</th>
                <th class="col-6">Vin</th>
                <th class="col-2">Actions</th>
            </tr>
        </thead>
        <?php if (!$qrlist): ?>
            <tbody>
                <tr><td colspan=4><center><i>Vous n'avez pas encore créé de QRCode</i></center></td></tr>
            </tbody>
        <?php else: ?>
            <tbody>

                <?php foreach($qrlist as $qr): ?>
                    <?php  ?>
                    <tr>
                        <td><input form="multiExportForm" type="checkbox" name="qrcodes[]" value='<?php echo $qr->id; ?>'></td>
                        <td><?php echo $qr->domaine_nom; ?></td>
                        <td>
                            <?php echo $qr->cuvee_nom; ?>
                            <?php echo $qr->appellation; ?> <?php echo $qr->couleur; ?>
                            <?php echo $qr->millesime; ?> -
                            <?php echo $qr->centilisation; ?> cl
                        </td>
                        <td>
                            <a title="Modifier le QRCode" class="p-1 text-dark" href="/qrcode/<?php echo $qr->user_id ?>/edit/<?php echo $qr->id ?>"><i class="bi bi-pencil-fill"></i></a>
                            <a title="Visualiser le QRCode" class="p-1 text-dark" href="/qrcode/<?php echo $qr->user_id ?>/parametrage/<?php echo $qr->id ?>"><i class="bi bi-qr-code"></i></a>
                            <a title="Dupliquer" href="/qrcode/<?php echo $qr->user_id ?>/duplicate/<?php echo $qr->id ?>" class="text-dark float-end"><i class="bi bi-copy"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        <?php endif; ?>
    </table>

    <div class="col">
        <a href="/qrcode/<?php echo $userid ?>/create" class="btn btn-primary pull-end">Créer un nouveau QRCode</a>
    </div>
</div>

<script>

document.getElementById('allCheck').addEventListener("click", function() {
    document.querySelectorAll('[name^=qrcodes]').forEach(function (checkbox) {
        checkbox.checked = document.getElementById('allCheck').checked;
    });
});

document.querySelector('#list_qr').addEventListener('change', function (e) {
    if (e.target.type == 'checkbox' ) {
        document.getElementById('multiExportBtn').disabled = document.querySelectorAll('[name^=qrcodes]:checked').length == 0;
    }
})


</script>
