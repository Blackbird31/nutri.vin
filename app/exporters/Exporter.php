<?php

namespace app\exporters;

use app\exporters\QRCodeNatif;
use app\exporters\QRCodeRSVG;
use app\exporters\utils\rsvgconvert;

class Exporter
{
    const formats = ['svg', 'eps', 'pdf'];
    private $renderer;

    public static function renderer($format, $options = [])
    {
        if (in_array($format, self::formats) === false) {
            http_response_code(415);
            die("Le format demandé n'est pas supporté ($format). Formats supportés : ".implode(', ', self::formats));
        }

        $rsvg = new rsvgconvert();

        return ($rsvg->exists() === false)
                ? new QRCodeNatif($format, $options)
                : new QRCodeRSVG($format, $options, $rsvg);
    }
}
