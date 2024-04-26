<?php
require_once('controllers/CtrlNutriVin.class.php');

$f3->route('GET /', 'CtrlNutriVin->home');
$f3->route('GET /admin/setup', 'CtrlNutriVin->setup');
$f3->route('GET /qrcode/@userid/create', 'CtrlNutriVin->qrcodeCreate');
$f3->route('POST /qrcode/@userid/write', 'CtrlNutriVin->qrcodeWrite');
$f3->route('GET /qrcode/@userid/edit/@qrcodeid', 'CtrlNutriVin->qrcodeEdit');
$f3->route('GET /qrcode/@userid/edit/@qrcodeid/img/@index/delete', 'CtrlNutriVin->qrcodeDeleteImage');
$f3->route('GET /qrcode/@userid/list', 'CtrlNutriVin->qrcodeList');
$f3->route('GET /qrcode/@userid/duplicate/@qrcodeid', 'CtrlNutriVin->qrcodeDuplicate');
$f3->route('GET /qrcode/@userid/multiexport', 'CtrlNutriVin->qrcodeMultiExport');
$f3->route('GET /qrcode', 'CtrlNutriVin->qrcodeAuthentication');
$f3->route('GET @qrview: /@qrcodeid', 'CtrlNutriVin->qrcodeView');
$f3->route('GET @qrcodeexport: /@qrcodeid/@format', 'CtrlNutriVin->export');
$f3->route('GET /qrcode/@userid/parametrage/@qrcodeid', 'CtrlNutriVin->qrcodeParametrage');
$f3->route('POST /qrcode/@userid/parametrage/@qrcodeid', 'CtrlNutriVin->qrcodeDisplay');
