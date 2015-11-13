<?php

use Symfony\Component\Templating\PhpEngine;
use Symfony\Component\Templating\TemplateNameParser;
use Symfony\Component\Templating\Loader\FilesystemLoader;

$app = new Silex\Application();

$app->register(new Silex\Provider\MonologServiceProvider(), array(
    'monolog.logfile' => __DIR__.'/development.log',
));

$app['monolog']->addDebug('Testing the Monolog logging.');

$app->get('/', function() use($app) {

    return require __DIR__.'/../app/views/welcome.php';

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

$app->run();