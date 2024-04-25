<?php

namespace app\exporters\Options;

use chillerlan\QRCode\QROptions;
use chillerlan\QRCode\Data\QRMatrix;
use chillerlan\QRCode\Output\QROutputInterface;

class QRCodePDFOptions extends QRCodeGeneralOptions
{
    protected string $outputType = QROutputInterface::FPDF;
    protected string $fpdfMeasureUnit = 'mm';

    public static function setResponseHeaders()
    {
        header('Content-type: application/pdf');
        header('Content-Disposition: filename="qrcode.pdf"');
    }

    public function setLogo($logo)
    {
        // Not working with this format
    }

}
