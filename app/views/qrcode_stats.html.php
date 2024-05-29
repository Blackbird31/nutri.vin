<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
  <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/qrcode/<?php echo $qrcode->user_id ?>/list">Liste de vos QR Codes</a></li>
      <li class="breadcrumb-item"><a href="/qrcode/<?php echo $qrcode->user_id ?>/parametrage/<?php echo $qrcode->getId(); ?>"><?php echo $qrcode->getId(); ?></a></li>
      <li class="breadcrumb-item active" aria-current="page">Statistique relative à un QR Code</li>
  </ol>
</nav>

<div class="mb-4">
    <h1 class="text-center">Stat <?php echo ($type == 'week') ? 'temporelle' : 'géographique'; ?> d'un QRcode</h1>
    <h2 class="text-center text-muted">
    <?php echo $qrcode->cuvee_nom; ?>
    <?php echo $qrcode->appellation; ?> <?php echo $qrcode->couleur; ?>
    <?php echo $qrcode->millesime; ?>
    <?php echo ($qrcode->centilisation) ? ' - '.$qrcode->centilisation . ' cl' : ''; ?>
    </h2>
</div>
<div class="row">
<div class="offset-1 col-10">
<table class="table">
    <thead>
            <th><?php echo ($type == 'week') ? 'Date' : 'Localisation'; ?></th>
            <th>Visites</th>
    </thead>
    <tbody>
    <?php if (!$qrcode->getVisites()): ?>
        <tr><td colspan="2" class="text-center">Ce QRCode n'a pas encore été visité</td></tr>
    <?php else: ?>
    <?php foreach($qrcode->getStats($type) as $k => $s): ?>
    <tr>
        <?php if ($type == 'week'): ?>
        <td>Semaine du <?php echo date('j/m/y', strtotime($s['name'])); ?></td>
        <?php else: ?>
        <td><?php echo $s['name']; ?></td>
        <?php endif; ?>
        <td class="text-end"><?php echo $s['nb']; ?></td>
    </tr>
    <?php endforeach ?>
    <?php endif ?>
    </tbody>
</table>
</div>

<div class="mt-5">
    <div class="row">
    <p class="col-6"><a href="/qrcode/<?php echo $qrcode->user_id ?>/list" class="btn btn-light"><i class="bi bi-chevron-compact-left"></i> Retour à la liste</a></p>
    <p class="col-6 text-end"><a href="/qrcode/<?php echo $qrcode->user_id ?>/stats/<?php echo $qrcode->getId(); ?>/<?php echo ($type == 'week') ? 'geo' : 'week'; ?>" class="btn btn-success">Vue <?php echo ($type != 'week') ? 'temporelle' : 'géographique'; ?> <i class="bi bi-chevron-compact-right"></i> </a></p>
</div>

</div>
