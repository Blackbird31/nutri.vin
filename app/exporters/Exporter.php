<?php

namespace app\exporters;

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use chillerlan\QRCode\Common\EccLevel;
use chillerlan\QRCode\Output\QRImagick;
use chillerlan\QRCode\Output\QREps;

class Exporter
{
    const formats = ['svg', 'eps'];
    private $format;
    private $configuration;

    public function __construct($format)
    {
        $this->format = $format;
        $this->configuration = new QROptions;

        if (in_array($this->format, self::formats) === false) {
            http_response_code(415);
            die("Le format demandé n'est pas supporté ($format). Formats supportés : ".implode(', ', self::formats));
        }

        $this->loadConfiguration();
    }

    public function loadConfiguration()
    {
        $this->configuration->outputInterface = QRImagick::class;
        $this->configuration->eccLevel = EccLevel::H;
        $this->configuration->imagickFormat = $this->format;
        $this->configuration->outputBase64 = false;

        // load config file / post value / database ?
    }

    public function addLogo($logo)
    {
        $this->configuration->addLogoSpace = true;
        $this->configuration->logoSpaceWidth = 8;
        $this->configuration->logoSpaceHeight = 8;
    }

    public function render($data)
    {
        if ($this->format === 'eps') {
            header('Content-type: application/postscript');
            header('Content-Disposition: filename="qrcode.eps"');
        } elseif ($this->format === 'svg') {
            header('Content-type: image/svg+xml');
        }

        $out = (new QRCode($this->configuration))->render($data);

        if(extension_loaded('zlib')){
            header('Vary: Accept-Encoding');
            header('Content-Encoding: gzip');
            $out = gzencode($out, 9);
        }

        return $out;
    }
}
