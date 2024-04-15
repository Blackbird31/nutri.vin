<?php

namespace app\exporters;

use chillerlan\QRCode\QROptions;
use chillerlan\QRCode\QRCodeException;

class QRCodeSVGOptions extends QROptions
{
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
}
