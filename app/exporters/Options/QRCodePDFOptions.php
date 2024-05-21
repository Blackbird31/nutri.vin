<?php

namespace app\exporters\Options;

use chillerlan\QRCode\QROptions;
use chillerlan\QRCode\Data\QRMatrix;
use chillerlan\QRCode\Output\QROutputInterface;

class QRCodePDFOptions extends QRCodeGeneralOptions
{
    protected string $outputType = QROutputInterface::FPDF;
    protected string $fpdfMeasureUnit = 'mm';

    protected string $fpdfTitle = '';

    public static function setResponseHeaders()
    {
        header('Content-type: application/pdf');
        header('Content-Disposition: filename="qrcode.pdf"');
    }

    public function setLogo($logo)
    {
        // Not working with this format
    }

    public function setTitle($title)
    {
        $this->outputType = QROutputInterface::CUSTOM;
        $this->outputInterface = QRFpdfCustom::class;

        $this->returnResource = true;
        $this->fpdfTitle = mb_convert_encoding($title, "ISO-8859-15", "UTF-8");
    }
}
