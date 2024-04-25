<?php

namespace app\exporters\Options;

use app\exporters\QRCodeSVG;
use chillerlan\QRCode\QROptions;
use chillerlan\QRCode\QRCodeException;
use chillerlan\QRCode\Data\QRMatrix;
use chillerlan\QRCode\Output\QROutputInterface;

class QRCodeSVGOptions extends QROptions
{
    protected string $outputType = QROutputInterface::MARKUP_SVG;

    protected string $svgLogo;
    protected float $svgLogoScale = 0.20;
    protected string $svgLogoCssClass = '';

    // check logo
    protected function set_svgLogo(string $svgLogo)
    {
        if(!file_exists($svgLogo) || !is_readable($svgLogo)) {
            throw new QRCodeException('invalid svg logo');
        }

        // @todo: validate svg

        $this->svgLogo = $svgLogo;
    }

    // clamp logo scale
    protected function set_svgLogoScale(float $svgLogoScale)
    {
        $this->svgLogoScale = max(0.05, min(0.3, $svgLogoScale));
    }

    public function setLogo($logo)
    {
        $this->outputType = QROutputInterface::CUSTOM;
        $this->outputInterface = QRMarkupSVGLogo::class;

        $this->svgLogo = $logo;
        $this->svgLogoScale = 0.25;
        $this->svgLogoCssClass = 'dark';
    }

    public static function setResponseHeaders()
    {
        header('Content-type: image/svg+xml');
    }

    public function postProcess($output)
    {
        return $output;
    }
}
