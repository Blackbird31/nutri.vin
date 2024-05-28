<?php

# Adapté de https://pretzelhands.com/posts/build-your-own-psr-4-autoloader/ pour
# fonctionner avec des librairies avec un namespace sur deux niveaux
#
# Le FQCN de la classe est donné en paramètre de l'autoloader. On extrait son namespace de
# premier niveau, on regarde s'il existe dans notre tableau de namespace enregistré ($psr4).
# Si ce n'est pas le cas, on ajoute un niveau tant qu'on en trouve.
# Quand on trouve un namespace enregistré, on transforme le FQCN en un chemin grace
# au chemin enregistré dans notre tableau de namespace

$psr4 = [
    "app\\" => "../app",
    "tests\\" => "../tests",
    "chillerlan\\QRCode\\" => "php-qrcode/src",
    "chillerlan\\Settings\\" => "php-settings-container/src",
    "TCPDF\\" => "tcpdf",
    "DB\\" => "php-couchdb/src"
];

function parsePrefix($class, $psr4) {
    $class .= '\\';

    if (array_key_exists($class, $psr4) === false) {
        $next = strtok('\\');
        return ($next === false) ? false : parsePrefix($class.$next, $psr4);
    }

    return $class;
}

function fqcnToPath($fqcn, $prefix) {
    $relativeClass = str_replace($prefix, '', $fqcn);

    return str_replace('\\', '/', $relativeClass) . '.php';
}

spl_autoload_register(function ($class) use ($psr4) {
    $prefix = strtok($class, '\\');
    $prefix = parsePrefix($prefix, $psr4);

    if ($prefix === false) { return; }

    $baseDirectory = $psr4[$prefix];
    $path = fqcnToPath($class, $prefix);

    $file = __DIR__.'/'.$baseDirectory.'/'.$path;
    $file = is_file($file) ? $file : str_replace('.php', '.class.php', $file);

    require $file;
});
