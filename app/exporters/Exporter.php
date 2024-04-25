<?php

namespace app\exporters;

use app\exporters\QRCodeNatif;
use app\exporters\QRCodeRSVG;
use app\exporters\utils\rsvgconvert;

class Exporter
{
    protected static $instance = null;

    public static function getInstance()
    {
        if(!is_null(self::$instance)) {
            return self::$instance;
        }

        if(rsvgconvert::commandExists()) {
            self::$instance = new ExporterRSVG();
        } else {
            self::$instance = new ExporterNatif();
        }

        return self::$instance;
    }
}
