<?php

namespace app\exporters\Options;

use chillerlan\QRCode\Output\QRFpdf;

class QRFpdfCustom extends QRFpdf
{
    public function dump(string $file = null) // la signature doit correspondre au parent
    {
        $fpdf = parent::dump($file);
        $fpdf->SetFont('Arial','', 8 * $this->scale);
        $fpdf->text(ceil($this->length / 2) - ($fpdf->GetStringWidth($this->options->fpdfTitle) / 2), 18, $this->options->fpdfTitle);

        $fpdf->text(ceil($this->length / 2) - ($fpdf->GetStringWidth($this->getEnergies()) / 2), $this->length - 1.5 * $this->scale, $this->getEnergies());

        $pdfData = $fpdf->Output('S');

        if($file !== null){
            $this->saveToFile($pdfData, $file);
        }

        if($this->options->imageBase64){
            $pdfData = sprintf('data:application/pdf;base64,%s', base64_encode($pdfData));
        }

        return $pdfData;
    }

    protected function getEnergies()
    {
        return sprintf("E = %s KCal / %s KJ", $this->options->fpdfEnergies[0], $this->options->fpdfEnergies[1]);
    }
}
