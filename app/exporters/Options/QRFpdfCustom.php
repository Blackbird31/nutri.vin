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

        $pdfData = $fpdf->Output('S');

        if($file !== null){
            $this->saveToFile($pdfData, $file);
        }

        if($this->options->imageBase64){
            $pdfData = sprintf('data:application/pdf;base64,%s', base64_encode($pdfData));
        }

        return $pdfData;
    }
}
