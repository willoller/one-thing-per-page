<?php

use Symfony\Component\HttpFoundation\Response;

// Home Page
$app->get('/', function() use($app, $templating)
{
    $app['monolog']->addInfo('A user came to the home page');

    return $templating->render('welcome.php', []);
});

// Ad Page
$app->get('/buy-index-cards', function() use($app)
{
    $app['monolog']->addInfo('A user clicked our ad!');

    $redirect = "http://www.amazon.com/gp/product/B002OB49L4/ref=as_li_ss_tl?ie=UTF8&camp=1789&creative=390957&creativeASIN=B002OB49L4&linkCode=as2&tag=willollercom-20";

    return $app->redirect($redirect);
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

// Log POST route
$app->post('/log', function() use($app)
{
    $input = file_get_contents('php://input');
    $json = json_decode($input);

    $message = $json->message;
    $level = $json->level;

    $app['monolog']->log($level, $message, array("client-side"));

    return new Response("OK", 200);
});

