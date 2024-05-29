<?php

use app\models\DBManager;

$f3 = require(__DIR__.'/vendor/fatfree-core/base.php');

require __DIR__.'/vendor/autoload.php';

if(getenv("DEBUG")) {
    $f3->set('DEBUG', getenv("DEBUG"));
}
$f3->set('ROOT', __DIR__);
$f3->set('UI', $f3->get('ROOT')."/app/views/");
$f3->set('THEME', $f3->get('ROOT')."/themes/ivso/");

setlocale(LC_ALL, '');
$f3->language(isset($f3->get('HEADERS')['Accept-Language']) ? $f3->get('HEADERS')['Accept-Language'] : '');

$f3->set('SUPPORTED_LANGUAGES',
    [
        'en_US.utf8' => 'English',
        'fr_FR.utf8' => 'Français',
    ]);
if ($f3->get('GET.lang')) {
    selectLanguage($f3->get('GET.lang'), $f3, true);
} elseif (isset($_COOKIE['LANGUAGE'])) {
    selectLanguage($_COOKIE['LANGUAGE'], $f3, true);
} else {
    selectLanguage($f3->get('LANGUAGE'), $f3);
}

if (!$f3->get('current_language')) {
    $f3->set('current_language', 'fr_FR.utf8');
}

$domain = basename(glob($f3->get('ROOT')."/locale/application.pot")[0], '.pot');

bindtextdomain($domain, $f3->get('ROOT')."/locale");
textdomain($domain);

require_once('config/config.php');
$f3->set('config', $config);

if (isset($config['urlbase'])) {
    $f3->set('urlbase', $config['urlbase']);
}else{
    $port = $f3->get('PORT');
    $f3->set('urlbase', $f3->get('SCHEME').'://'.$_SERVER['SERVER_NAME'].(!in_array($port,[80,443])?(':'.$port):'').$f3->get('BASE'));
}

if (isset($config['dbpdo']) && $config['db_pdo']) {
    DBManager::createDB($config['db_pdo']);
}else{
    DBManager::createDB('sqlite://'.__DIR__.'/db/nutrivin.sqlite');
}

include('app/routes.php');


function selectLanguage($lang, $f3, $putCookie = false) {
    $langSupported = null;
    foreach(explode(',', $lang) as $l) {
        if(array_key_exists($l, $f3->get('SUPPORTED_LANGUAGES'))) {
            $langSupported = $l;
            break;
        }
    }
    if(!$langSupported) {
        return null;
    }
    if($putCookie) {
        $cookieDate = strtotime('+1 year');
        setcookie("LANGUAGE", $langSupported, ['expires' => $cookieDate, 'samesite' => 'Strict', 'path' => "/"]);
    }
    $f3->set('current_language', $langSupported);
    putenv("LANGUAGE=$langSupported");
}




return $f3;
