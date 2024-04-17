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

    public function setColors($color)
    {
        $this->moduleValues = [
            QRMatrix::M_DATA_DARK => $color,
        ];
    }

    public function setLogo($logo)
    {
        $this->outputType = QROutputInterface::CUSTOM;
        $this->outputInterface = QRCodeSVG::class;

        $this->svgLogo = $logo;
        $this->svgLogoScale = 0.25;
        $this->svgLogoCssClass = 'dark';
    }

    public function setResponseHeaders($moreHeaders = [])
    {
        header('Content-type: image/svg+xml');

        foreach ($moreHeaders as $header => $value) {
            header($header.': '.$value);
        }
    }

    public function postProcess($output)
    {
        return $output;
    }
}
