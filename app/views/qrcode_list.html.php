<h2 class="text-center"><?php echo $userid;?> QR Codes</h2>

<h3 class="mt-4 ">Liste des QR code</h3>

<table class="table table-bordered table-striped text-center">

  <thead>
    <tr>
      <th>Nom commercial</th>
      <th>Appellation</th>
      <th>Cuvée</th>
      <th>Conditionnement (en cl)</th>
      <th>Millésime</th>
      <th>Actions</th>
    </tr>
  </thead>

  <tbody>
    <?php foreach($qrlist as $qr): ?>
      <tr>
        <td><?php echo $qr->domaine_nom; ?></td>
        <td><?php echo $qr->appellation; ?></td>
        <td><?php echo $qr->cuvee_nom; ?></td>
        <td><?php echo $qr->centilisation; ?> cl</td>
        <td><?php echo $qr->millesime; ?></td>
        <td class="">
            <a class="p-1" href="<?php echo $urlbase.'/qrcode/'.$qr->user_id.'/edit/'.$qr->id ?>" style="color: black;">
                <i class="bi bi-pencil-fill"></i></a>
            <a class="p-1" href="<?php echo $urlbase.'/'.$qr->id ?>" style="color: black;">
                <i class="bi bi-eye-fill"></i></a>
            <a class="p-1" href="<?php echo $urlbase.'/'.$qr->id.'/svg' ?>" style="color: black;">
                <i class="bi bi-qr-code"></i></a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>

</table>
