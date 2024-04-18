<?php

namespace app\exporters;

use app\exporters\Options\QRCodeSVGOptions;
use app\exporters\Options\QRCodeEPSOptions;
use app\exporters\Options\QRCodePDFOptions;

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\Common\EccLevel;

class QRCodeNatif
{
    private $format;
    private $options;
    private $configuration;
    private $qroptions = [
        'svg' => QRCodeSVGOptions::class,
        'eps' => QRCodeEPSOptions::class,
        'pdf' => QRCodePDFOptions::class,
    ];

    public function __construct($format, $options)
    {
        $this->format = $format;
        $this->options = $options;
        $this->configuration = new $this->qroptions[$format];
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

        return $this->configuration->postProcess($out);
    }
}
