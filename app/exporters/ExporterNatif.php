<?php

namespace app\exporters;

use app\exporters\Options\QRCodeSVGOptions;
use app\exporters\Options\QRCodeEPSOptions;
use app\exporters\Options\QRCodePDFOptions;

use chillerlan\QRCode\QRCode;

class ExporterNatif
{
    private $qroptions = [
        'svg' => QRCodeSVGOptions::class,
        'eps' => QRCodeEPSOptions::class,
        'pdf' => QRCodePDFOptions::class,
    ];

    public function setResponseHeaders($format) {

        return $this->qroptions[$format]::setResponseHeaders();
    }

    public function getQRCodeContent($qrCodeData, $format, $logo = false) {
        $configuration = new $this->qroptions[$format];

        if($logo) {
            $configuration->setLogo($logo);
        }

        $configuration->setTitle("  INGRÉDIENTS :");
        $content = (new QRCode($configuration))->render($qrCodeData);

        if($format == 'eps') {
            $content = str_replace(',', '.',$content);
        }

        return $content;
    }

}
