<?php

namespace app\exporters;

use app\exporters\Options\QRCodeSVGOptions;
use app\exporters\utils\rsvgconvert;

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\Common\EccLevel;

class QRCodeRSVG
{
    private $format;
    private $options;
    private $configuration;
    private $rsvg;

    public function __construct($format, $options, rsvgconvert $rsvg)
    {
        $this->format = $format;
        $this->options = $options;
        $this->rsvg = $rsvg;
        $this->configuration = new QRCodeSVGOptions;
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
                $this->configuration->setColors($this->options['color']);
            }
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
        return $this->{$this->format}($out);
    }

    public function svg($output)
    {
        header('Content-type: image/svg+xml');
        return $output;
    }

    public function pdf($output)
    {
        header('Content-type: application/pdf');
        header('Content-Disposition: filename="qrcode.pdf"');

        return $this->rsvg->convert($output, $this->format);
    }

    public function eps($output)
    {
        header('Content-type: application/postscript');
        header('Content-Disposition: filename="qrcode.eps"');

        return $this->rsvg->convert($output, $this->format);
    }
}
