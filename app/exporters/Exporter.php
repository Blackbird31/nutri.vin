<?php

namespace app\exporters;

use app\exporters\QRCodeSVG;
use app\exporters\QRCodeSVGOptions;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\Common\EccLevel;
use chillerlan\QRCode\Data\QRMatrix;
use chillerlan\QRCode\Output\QROutputInterface;
use chillerlan\QRCode\Output\QRMarkupSVG;
use chillerlan\QRCode\Output\QREps;

class Exporter
{
    const formats = ['svg', 'eps'];
    private $format;
    private $configuration;
    private $options;

    public function __construct($format, $options = [])
    {
        $this->format = $format;
        $this->options = $options;
        $this->configuration = new QRCodeSVGOptions;

        if (in_array($this->format, self::formats) === false) {
            http_response_code(415);
            die("Le format demandé n'est pas supporté ($format). Formats supportés : ".implode(', ', self::formats));
        }

        $this->loadConfiguration();
    }

    public function loadConfiguration()
    {
        $this->configuration->outputInterface = QRMarkupSVG::class;
        $this->configuration->eccLevel = EccLevel::H;
        $this->configuration->outputBase64 = false;
        $this->configuration->connectPaths = true;
        $this->configuration->addQuietzone = true;
        $this->configuration->svgUseFillAttribute = true;
        $this->configuration->drawLightModules = false;

        // load config file / post value / database ?
        if (count($this->options)) {
            if (isset($this->options['color'])) {
                $this->configuration->moduleValues = [
                    QRMatrix::M_DATA_DARK => $this->convertColor($this->options['color']),
                ];
            }
        }
    }

    private function convertColor($color)
    {
        if ($this->format === 'svg') return $color;

        if (strpos($color, '#') === 0) {
            return sscanf($color, "#%02x%02x%02x");
        }
    }

    public function addLogo($logo)
    {
        $this->configuration->outputType = QROutputInterface::CUSTOM;
        $this->configuration->outputInterface = QRCodeSVG::class;
        $this->configuration->addLogoSpace = true;
        $this->configuration->logoSpaceWidth = 8;
        $this->configuration->logoSpaceHeight = 8;
        $this->configuration->svgLogo = $logo;
        $this->configuration->svgLogoScale = 0.25;
        $this->configuration->svgLogoCssClass = 'dark';
    }

    public function render($data)
    {
        if ($this->format === 'eps') {
            header('Content-type: application/postscript');
            header('Content-Disposition: filename="qrcode.eps"');

            $this->configuration->outputInterface = QREps::class;

            $out = (new QRCode($this->configuration))->render($data);
            $out = str_replace(',', '.', $out);
        } elseif ($this->format === 'svg') {
            header('Content-type: image/svg+xml');

            $out = (new QRCode($this->configuration))->render($data);
        }

        if(extension_loaded('zlib')){
            header('Vary: Accept-Encoding');
            header('Content-Encoding: gzip');
            $out = gzencode($out, 9);
        }

        return $out;
    }
}
