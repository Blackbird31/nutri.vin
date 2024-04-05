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
          <div class="dropdown">
            <span class="bi bi-gear-fill" type="button" data-bs-toggle="dropdown" aria-expanded="false"></span>
            <ul class="dropdown-menu">
              <li><a href="<?php echo $urlbase.'/qrcode/'.$qr->user_id.'/edit/'.$qr->id ?>" class="dropdown-item">Editer</a></li>
              <li></li>
              <li></li>
            </ul>
          </div>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>

</table>
