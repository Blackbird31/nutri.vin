<?php
require_once('controllers/CtrlNutriVin.class.php');

$f3->route('GET /', 'CtrlNutriVin->home');
$f3->route('GET /admin/setup', 'CtrlNutriVin->setup');
$f3->route('GET /qrcode/@userid/create', 'CtrlNutriVin->qrcodeCreate');
$f3->route('POST /qrcode/@userid/write', 'CtrlNutriVin->qrcodeWrite');
$f3->route('GET /qrcode/@userid/edit/@id', 'CtrlNutriVin->qrcodeEdit');
$f3->route('GET /qrcode/@userid/edit/@id/img/@index/delete', 'CtrlNutriVin->qrcodeDeleteImage');
$f3->route('GET /qrcode/@userid/list', 'CtrlNutriVin->qrcodeList');
$f3->route('GET /qrcode', 'CtrlNutriVin->qrcodeAuthentication');
$f3->route('GET /connect', 'CtrlNutriVin->qrcodeAuthentication');
$f3->route('GET /connect/viticonnect', 'CtrlNutriVin->qrcodeViticonnect');
$f3->route('GET /disconnect', 'CtrlNutriVin->qrcodeDisconnect');
$f3->route('GET @qrview: /@qrcodeid', 'CtrlNutriVin->qrcodeView');
$f3->route('GET @qrcodeexport: /@qrcodeid/@format', 'CtrlNutriVin->export');
$f3->route('GET /qrcode/@userid/parametrage/@id', 'CtrlNutriVin->qrcodeParametrage');
