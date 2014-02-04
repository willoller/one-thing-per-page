<?php

date_default_timezone_set('America/Los_Angeles');
error_reporting(E_ALL); 
ini_set( 'display_errors','1');

require_once __DIR__.'/../app/vendor/autoload.php';

use Symfony\Component\Templating\PhpEngine;
use Symfony\Component\Templating\TemplateNameParser;
use Symfony\Component\Templating\Loader\FilesystemLoader;

$loader = new FilesystemLoader(__DIR__.'/../app/views/%name%');
$templating = new PhpEngine(new TemplateNameParser(), $loader);

$app = new Silex\Application();
$app['debug'] = true;


$app['redis'] = $app->share(function () {
	$client = new Predis\Client();
});


$app->get('/', function() use($app, $templating) {

	return $templating->render('welcome.php', []);

});

$app->get('/test', function() use($app, $templating) {

	return "Test Controller";

});

$app->post('/print', function() use ($app) {
	$pages = $_POST['pages'];

	$doc = new Models\Document();

	foreach ($pages as $p)
	{
		$doc->addCard($p);
	}

	$doc->stream();

	$app->setContentDisposition(ResponseHeaderBag::DISPOSITION_INLINE, 'page.pdf');
	return; 
});

$app->get('/page', function() use($app) {
	set_time_limit(2);

	$text = (isset($_GET['text'])) ? $_GET['text'] : 'You forgot to put in text.';

	$doc = new Models\Document();
	$doc->addCard($text);
	$doc->stream();

	$app->setContentDisposition(ResponseHeaderBag::DISPOSITION_INLINE, 'page.pdf');
	return; 
});


$app->run();