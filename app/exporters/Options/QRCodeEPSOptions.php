<?php

namespace app\exporters\Options;

use chillerlan\QRCode\QROptions;
use chillerlan\QRCode\Data\QRMatrix;
use chillerlan\QRCode\Output\QROutputInterface;

class QRCodeEPSOptions extends QROptions
{
    protected string $outputType = QROutputInterface::EPS;

    public function setColors($color)
    {
        $this->moduleValues = [
            QRMatrix::M_DATA_DARK => $color,
        ];
    }

    public function setLogo($logo)
    {
        /* Pas de possibilité de mettre un logo pour l'instant */
    }

    public function setResponseHeaders($moreHeaders = [])
    {
        header('Content-type: application/postscript');
        header('Content-Disposition: filename="qrcode.eps"');

        foreach ($moreHeaders as $header => $value) {
            header($header.': '.$value);
        }
    }

    public function postProcess($output)
    {
        return str_replace(',', '.', $output);
    }
}

