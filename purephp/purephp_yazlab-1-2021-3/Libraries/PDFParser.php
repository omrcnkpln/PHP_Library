<?php
include "../vendor/autoload.php";

class PDFParser
{
    public $text;

    public function __construct($prm)
    {
        $parser = new \Smalot\PdfParser\Parser();
        $pdf = $parser->parseFile('../Assets/Imports/'.$prm);
        $text = $pdf->getText();
        $string = str_replace(' ', '', $text);

        $this->text = $string;
    }
}
