<?php

namespace app\exporters\Options;

use chillerlan\QRCode\QROptions;
use chillerlan\QRCode\Data\QRMatrix;
use chillerlan\QRCode\Output\QROutputInterface;

class QRCodePDFOptions extends QROptions
{
    protected string $outputType = QROutputInterface::FPDF;
    protected string $fpdfMeasureUnit = 'mm';

    public function setColors($color)
    {
        $this->moduleValues = [
            // finder
            QRMatrix::M_FINDER_DARK    => [0, 63, 255],    // dark (true)
            QRMatrix::M_FINDER_DOT     => [0, 63, 255],    // finder dot, dark (true)
            QRMatrix::M_FINDER         => [255, 255, 255], // light (false)
            // alignment
            QRMatrix::M_ALIGNMENT_DARK => [255, 0, 255],
            QRMatrix::M_ALIGNMENT      => [255, 255, 255],
            // timing
            QRMatrix::M_TIMING_DARK    => [255, 0, 0],
            QRMatrix::M_TIMING         => [255, 255, 255],
            // format
            QRMatrix::M_FORMAT_DARK    => [67, 191, 84],
            QRMatrix::M_FORMAT         => [255, 255, 255],
            // version
            QRMatrix::M_VERSION_DARK   => [62, 174, 190],
            QRMatrix::M_VERSION        => [255, 255, 255],
            // data
            QRMatrix::M_DATA_DARK      => [0, 0, 0],
            QRMatrix::M_DATA           => [255, 255, 255],
            // darkmodule
            QRMatrix::M_DARKMODULE     => [0, 0, 0],
            // separator
            QRMatrix::M_SEPARATOR      => [255, 255, 255],
            // quietzone
            QRMatrix::M_QUIETZONE      => [255, 255, 255],
        ];
    }

    public function setLogo($logo)
    {
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
