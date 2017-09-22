<?php

use Symfony\Component\HttpFoundation\Response;

// Home Page
$app->get('/', function() use($app, $templating)
{
    $app['monolog']->addInfo('A user came to the home page');

    return $templating->render('welcome.php', []);
});

// Print Page
$app->post('/print', function() use ($app)
{
    $pages = $_POST['pages'];

    $doc = new Models\Document();

    foreach ($pages as $p) {
        $doc->addCard($p);
    }

    $app['monolog']->addInfo('A user printed ' . count($pages) . ' pages');

    return new Response($doc->output(), 200, array(
        'Content-Type'        => 'application/pdf',
        'Content-Disposition' => 'inline; filename="stack.pdf"' 
    ));

});

