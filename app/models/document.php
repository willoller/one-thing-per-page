<?php

namespace Models;

class Document {

	public $pdf = null;
	public $page_count = 0;

	public function __construct()
	{
		$this->pdf = new \Cezpdf([20.3,12.7]);
		$this->pdf->ez['topMargin']    = $this->pdf->ez['pageHeight'] / 12;
		$this->pdf->ez['bottomMargin'] = $this->pdf->ez['pageHeight'] / 12;
		$this->pdf->ez['leftMargin']   = $this->pdf->ez['pageWidth'] / 14;
		$this->pdf->ez['rightMargin']  = $this->pdf->ez['pageWidth'] / 14;
		$this->pdf->selectFont(realpath(__DIR__ . '/../vendor/rebuy/ezpdf/src/ezpdf/fonts/Helvetica.afm'));
		$this->pdf->setColor(0.4, 0.4, 0.4);
	}

	public function addCard($text)
	{
		$this->page_count++;

		if ($this->page_count > 1)
			$this->pdf->ezNewPage();

		for ($font = 200; $font > 0; $font--)
		{
			$spacing = 0.80;
			if ($font > 30) $spacing = 0.85;
			if ($font > 60) $spacing = 0.90;
			if ($font > 90) $spacing = 0.95;
			if ($font > 120) $spacing = 1.00;

			if (!$this->pdf->ezText($text, $font, ["justification" => "center", "spacing" => $spacing], true))
			{
				$this->pdf->ezText($text, $font, ["justification" => "center", "spacing" => $spacing]);
				break;
			}
		}
	}

	public function stream()
	{
		$this->pdf->ezStream();
	}

	public function output()
	{
		$this->pdf->ezOutput();
	}
}