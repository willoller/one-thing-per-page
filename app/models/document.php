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

		$font = 1;
		$page_count = $this->pdf->ezPageCount;

		$spacing = 1.5;

		// How big is too big?
		while ($page_count == $this->page_count && $font < 400)
		{
			$this->pdf->transaction('start');

			$font++;

			$spacing = 1;
			//if ($font > 10) $spacing = 1.15;
			//if ($font > 20) $spacing = 0.95;
			if ($font > 30) $spacing = 0.9;
			if ($font > 60) $spacing = 0.8;
			if ($font > 120) $spacing = 0.75;

			$this->pdf->ezText($text, $font, ["justification" => "center", "spacing" => $spacing]);

			$page_count = $this->pdf->ezPageCount;

		    $this->pdf->transaction('rewind');
		}

		$font--;
		
		$this->pdf->ezText($text, $font, ["justification" => "center", "spacing" => $spacing]);
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