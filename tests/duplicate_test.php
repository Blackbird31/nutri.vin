<?php

use tests\factories\QRCodeFactory;
use app\models\QRCode;
use app\models\DBManager;

// INIT
$f3 = require(__DIR__.'/../vendor/fatfree-core/base.php');
require __DIR__.'/../vendor/autoload.php';
require __DIR__.'/../app/routes.php';

if (getenv('DEBUG')) {
    $f3->set('DEBUG', getenv('DEBUG'));
}

$test = new Test();

/** @return array $config */
require_once __DIR__.'/../config/config.php';
$f3->set('config', $config);

$couch = new \DB\Couch('http://admin:admin@127.0.0.1:5984/nutrivin_test');
try {
    $couch->getDBInfos();
    $couch->deleteDB();
} catch (\Exception $e) {
    $test->message('Pas de base existante');
}

DBManager::createDB('couchdb:http://admin:admin@127.0.0.1:5984/nutrivin_test');

QRCode::createTable();
$test->message('Création de la base');

$qrcode = QRCodeFactory::create();
$qrcode->image_etiquette = 'data:image/gif;base64,R0lGODdhAQABAPAAAP8AAAAAACwAAAAAAQABAAACAkQBADs='; // petit carré rouge
$qrcode->save();

// mock ne fonctionne pas avec les reroute() :(
// ni les autorisations
// on reproduit le fonctionnement du controller :
$fields = $qrcode->exportToHttp();
$test->expect($fields['domaine_nom'] === $qrcode->domaine_nom, "On exporte les valeurs");
$test->expect(isset($fields['image_etiquette'], $fields['image_etiquette']) === false, "On n'exporte pas les images");
$test->expect(Flash::instance()->hasKey('qrcode.image_etiquette') === true, "On a les images en session flash");

// reroute qrcodeCreate avec en GET : http_query_builder($fields)

$clone = new QRCode();
$clone->user_id = $qrcode->user_id; // pas de clone de l'userid
$clone->clone($fields);
$clone->save();

$test->expect($clone->domaine_nom === $qrcode->domaine_nom, "Le clone reprends les infos du QRCode original");
$test->expect($clone->getId() !== $qrcode->getId(), "Le clone ne reprends pas l'id du QRCode original");
$test->expect($clone->image_etiquette === $qrcode->image_etiquette, "On récupère l'image via la session");
$test->expect(Flash::instance()->hasKey('qrcode.image_etiquette') === false, "La session est clearée");

// Affichage des résultats
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
