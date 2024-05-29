<?php

use app\models\QRCode;
use app\models\DBManager;

// INIT
$f3 = require(__DIR__.'/../vendor/fatfree-core/base.php');
require __DIR__.'/../vendor/autoload.php';

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
/* DBManager::createDB('sqlite:'.__DIR__.'/../db/nutrivin_test.sqlite'); */

// TESTS
QRCode::createTable();
$test->message('Création de la base');

$qr = new QRCode();
$test->message('Création d\'un qrcode');

$test->expect(get_class($qr) === QRCode::class, "QRCode créé un qrcode");

$qr->domaine_nom = "Domaine test";
$qr->user_id = "userid";

$qr->save();

$test->expect($qr->_id !== null, "Le qrcode a un identifiant : $qr->_id");

$old_id = $qr->_id;
$qr = QRCode::findById($qr->_id);
@$test->expect(! is_null($qr), "On retrouve bien le qrcode");
@$test->expect($qr->_id === $old_id, "Son id est bien le même");
@$test->expect($qr->domaine_nom ===  "Domaine test", "Son domaine est bien le même");

$test->message('On créé un deuxième qrcode');
$qr2 = new QRCode();
$qr2->user_id = "userid";
$qr2->domaine_nom = "Domaine Lorem";
$qr2->logo = true;
$qr2->save();

$test->expect($qr2->_id !== null, "Le 2ème qrcode a un identifiant : $qr2->_id");
$test->expect($qr2->_id !== $qr->_id, "Le 2ème qrcode a un identifiant différent du premier");
$qr2 = QRCode::findById($qr2->_id);
$test->expect(! is_null($qr2), "On retrouve bien le 2ème qrcode");

$results = QRCode::findByUserid('userid');
$test->expect(count($results) === 2, "La recherche par userid retourne bien 2 résultats");
$test->expect(get_class($results[0]) === QRCode::class, "Ce sont bien des objets QRCode");
$test->expect(in_array($results[0]->_id, [$qr->_id, $qr2->_id]), "C'est bien 1 des QRcodes qu'on a créé auparavant");

$test->message("On créé un 3ème QRCode, mais un utilisateur différent");
$qr3 = new QRCode();
$qr3->user_id = "not_userid";
$qr3->domaine_nom = "NotUserid Domaine";
$qr3->save();

$results = QRCode::findByUserid('userid');
$test->expect(count($results) === 2, "Il y a toujours 2 résultats pour le premier utilisateur");

$results = QRCode::findByUserid('not_userid');
$test->expect(count($results) === 1, "Le 2ème utilisateur a bien un qrcode");
$test->expect($results[0]->_id === $qr3->_id, "C'est bien le QRCode qu'on lui a créé");

$results = QRCode::findByUserid('undefined_userid');
$test->expect(count($results) === 0, "Pas de résultats pour un utilisateur inexistant");

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
