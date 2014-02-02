<?php

date_default_timezone_set('America/Los_Angeles');
error_reporting(E_ALL); 
ini_set( 'display_errors','1');

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\Templating\PhpEngine;
use Symfony\Component\Templating\TemplateNameParser;
use Symfony\Component\Templating\Loader\FilesystemLoader;

$loader = new FilesystemLoader(__DIR__.'/../app/views/%name%');
$templating = new PhpEngine(new TemplateNameParser(), $loader);

$app = new Silex\Application();
$app['debug'] = true;

$app->get('/', function() use($app, $templating) {

	return $templating->render('welcome.php', []);

});

$app->get('/test', function() use($app, $templating) {

	return "Test Controller";

});

$app->get('/page', function() use($app) {

	set_time_limit(2);

	$text = (isset($_GET['text'])) ? $_GET['text'] : 'You forgot to put in text.';

	$pdf = new Cezpdf([20.3,12.7]);
	$pdf->ez['topMargin']    = $pdf->ez['pageHeight'] / 100;
	$pdf->ez['bottomMargin'] = $pdf->ez['pageHeight'] / 20;
	$pdf->ez['leftMargin']   = $pdf->ez['pageWidth'] / 20;
	$pdf->ez['rightMargin']  = $pdf->ez['pageWidth'] / 20;
	$pdf->selectFont(realpath(__DIR__ . '/../vendor/rebuy/ezpdf/src/ezpdf/fonts/Helvetica-Bold.afm'));

	$font = 24;
	$page_count = 1;

	// How big is too big?
	while ($page_count == 1 && $font < 400)
	{
		$pdf->transaction('start');

		$font++;

		$pdf->ezText($text, $font, ["justification" => "center"]);

		$page_count = $pdf->ezPageCount;

	    $pdf->transaction('rewind');
	}

	$font--;
	
	$pdf->ezText($text, $font, ["justification" => "center"]);

	$pdf->ezStream();
	$app->setContentDisposition(ResponseHeaderBag::DISPOSITION_INLINE, 'page.pdf');
	return; 
});


$app->run();