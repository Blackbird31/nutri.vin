<?php

$f3 = require(__DIR__.'/vendor/fatfree-core/base.php');

require __DIR__.'/vendor/autoload.php';

if(getenv("DEBUG")) {
    $f3->set('DEBUG', getenv("DEBUG"));
}
$f3->set('ROOT', __DIR__);
$f3->set('UI', $f3->get('ROOT')."/app/views/");
$f3->set('THEME', $f3->get('ROOT')."/themes/ivso/");

$port = $f3->get('PORT');
$f3->set('urlbase', $f3->get('SCHEME').'://'.$_SERVER['SERVER_NAME'].(!in_array($port,[80,443])?(':'.$port):'').$f3->get('BASE'));

require_once('config/config.php');
$f3->set('config', $config);

require_once('app/models/DBManager.class.php');
require_once('app/models/QRCode.class.php');

DBManager::createDB('sqlite:'.$f3->get('ROOT').'/db/nutrivin.sqlite');

include('app/routes.php');

return $f3;
