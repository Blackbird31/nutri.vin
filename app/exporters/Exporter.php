<?php

namespace app\exporters;

use app\exporters\QRCodeSVG;
use app\exporters\Options\QRCodeSVGOptions;
use app\exporters\Options\QRCodeEPSOptions;
use app\exporters\Options\QRCodePDFOptions;
use chillerlan\QRCode\{QRCode, QROptions};
use chillerlan\QRCode\Common\EccLevel;
use chillerlan\QRCode\Data\QRMatrix;
use chillerlan\QRCode\Output\QROutputInterface;
use chillerlan\QRCode\Output\QRMarkupSVG;
use chillerlan\QRCode\Output\QREps;

class Exporter
{
    const formats = ['svg', 'eps', 'pdf'];
    private $format;
    private $configuration;
    private $options;

    private $qroptions = [
        'svg' => QRCodeSVGOptions::class,
        'eps' => QRCodeEPSOptions::class,
        'pdf' => QRCodePDFOptions::class,
    ];

    public function __construct($format, $options = [])
    {
        $this->format = $format;
        $this->options = $options;

        if (in_array($this->format, self::formats) === false) {
            http_response_code(415);
            die("Le format demandé n'est pas supporté ($format). Formats supportés : ".implode(', ', self::formats));
        }

        $this->configuration = new $this->qroptions[$this->format];
        $this->loadConfiguration();
    }

    public function loadConfiguration()
    {
        // configuration commune
        $this->configuration->eccLevel = EccLevel::H;
        $this->configuration->outputBase64 = false;
        $this->configuration->connectPaths = true;
        $this->configuration->addQuietzone = true;
        $this->configuration->svgUseFillAttribute = true;
        $this->configuration->drawLightModules = false;

        // load config file / post value / database ?
        if (count($this->options)) {
            if (isset($this->options['color'])) {
                $this->configuration->setColors($this->convertColor($this->options['color']));
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
        $this->configuration->addLogoSpace = true;
        $this->configuration->logoSpaceWidth = 8;
        $this->configuration->logoSpaceHeight = 8;
        $this->configuration->setLogo($logo);
    }

    public function render($data)
    {
        $out = (new QRCode($this->configuration))->render($data);
        $this->configuration->setResponseHeaders();
        $out = $this->configuration->postProcess($out);

        if(extension_loaded('zlib')){
            header('Vary: Accept-Encoding');
            header('Content-Encoding: gzip');
            $out = gzencode($out, 9);
        }

        return $out;
    }
}
