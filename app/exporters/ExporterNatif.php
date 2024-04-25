<?php

namespace app\exporters;

use app\exporters\Options\QRCodeSVGOptions;
use app\exporters\Options\QRCodeEPSOptions;
use app\exporters\Options\QRCodePDFOptions;

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\Common\EccLevel;

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
        $configuration->eccLevel = EccLevel::H;
        $configuration->outputBase64 = false;
        $configuration->connectPaths = true;
        $configuration->addQuietzone = true;
        $configuration->svgUseFillAttribute = true;
        if($logo) {
            $configuration->addLogoSpace = true;
            $configuration->logoSpaceWidth = 8;
            $configuration->logoSpaceHeight = 8;
            $configuration->setLogo($logo);
        }

        $content = (new QRCode($configuration))->render($qrCodeData);

        if($format == 'eps') {
            $content = str_replace(',', '.',$content);
        }

        return $content;
    }

}
