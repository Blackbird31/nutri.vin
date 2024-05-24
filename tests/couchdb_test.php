<?php

// INIT
$f3 = require(__DIR__.'/../vendor/fatfree-core/base.php');
require __DIR__.'/../vendor/autoload.php';

$test = new Test();

/** @return array $config */
require_once __DIR__.'/../config/config.php';
$f3->set('config', $config);

require_once __DIR__.'/../app/models/DBManager.class.php';

$couch = new \DB\Couch('http://admin:admin@127.0.0.1:5984/nutrivin_test');
try {
    $couch->getDBInfos();
    $couch->deleteDB();
} catch (\Exception $e) {
    $test->message('Pas de base existante');
}

DBManager::createDB('couchdb:http://admin:admin@127.0.0.1:5984/nutrivin_test');
/* DBManager::createDB('sqlite:'.__DIR__.'/../db/nutrivin_test.sqlite'); */

// TESTS
require_once('app/models/QRCode.class.php');
QRCode::createTable();
$test->message('Création de la base');

$qr = new QRCode();
$test->message('Création d\'un qrcode');

$test->expect(get_class($qr) === QRCode::class, "QRCode créé un qrcode");

$qr->domaine_nom = "Domaine test";
$qr->user_id = "userid";

$qr->save();

$test->expect($qr->_id !== null, "Le qrcode a un identifiant : $qr->_id");

foreach ($test->results() as $result) {
    $status = ($result['status']) ? 'PASS' : 'FAIL';
    if (php_sapi_name() === 'cli') {
        switch ($status) {
            case 'PASS': $status = "\033[32m".$status."\033[0m"; break;
            case 'FAIL': $status = "\033[31m".$status."\033[0m"; break;
        }
    }
    echo sprintf("%s: %s (%s)".PHP_EOL, $status, $result['text'], $result['source']);
}
