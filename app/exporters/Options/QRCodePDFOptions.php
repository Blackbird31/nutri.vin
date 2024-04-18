<?php

namespace app\exporters\Options;

use chillerlan\QRCode\QROptions;
use chillerlan\QRCode\Data\QRMatrix;
use chillerlan\QRCode\Output\QROutputInterface;

class QRCodePDFOptions extends QROptions
{
    protected string $outputType = QROutputInterface::FPDF;
    protected string $fpdfMeasureUnit = 'mm';

    /* Hack */
    protected ?string $svgLogo = null;
    protected float $svgLogoScale;

    public function setColors($color)
    {
        $this->moduleValues = [
            // finder
            QRMatrix::M_FINDER_DARK    => $color,    // dark (true)
            QRMatrix::M_FINDER_DOT     => $color,    // finder dot, dark (true)
            // alignment
            QRMatrix::M_ALIGNMENT_DARK => $color,
            // timing
            QRMatrix::M_TIMING_DARK    => $color,
            // format
            QRMatrix::M_FORMAT_DARK    => $color,
            // version
            QRMatrix::M_VERSION_DARK   => $color,
            // data
            QRMatrix::M_DATA_DARK      => $color,
            // darkmodule
            QRMatrix::M_DARKMODULE     => $color,
        ];
    }

    public function setLogo($logo)
    {
        /* Pour l'instant, on ne peut pas rajouter de logo dans le pdf */
    }

    public function setResponseHeaders($moreHeaders = [])
    {
        header('Content-type: application/pdf');
        header('Content-Disposition: filename="qrcode.pdf"');

        foreach ($moreHeaders as $header => $value) {
            header($header.': '.$value);
        }
    }

    public function postProcess($output)
    {
        return $output;
    }
}
