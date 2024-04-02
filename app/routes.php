<?php
require_once('controllers/CtrlNutriVin.class.php');

$f3->route('GET /', 'CtrlNutriVin->home');
$f3->route('GET /admin/setup', 'CtrlNutriVin->setup');
$f3->route('GET /qrcode/@userid/create', 'CtrlNutriVin->qrcodeCreate');
$f3->route('POST /qrcode/@userid/write', 'CtrlNutriVin->qrcodeWrite');
$f3->route('GET /qrcode/@userid/edit/@id', 'CtrlNutriVin->qrcodeEdit');
$f3->route('GET /qrcode/@userid/list', 'CtrlNutriVin->qrcodeList');
$f3->route('GET /qrcode', 'CtrlNutriVin->qrcodeAuthentication');
$f3->route('GET /@qrcodeid', 'CtrlNutriVin->qrcodeView');
