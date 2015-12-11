<?php

$app->get('/', function() use($app, $templating)
{
    return $templating->render('welcome.php', []);
});

$app->post('/print', function() use ($app)
{
    $pages = $_POST['pages'];

    $doc = new Models\Document();

    foreach ($pages as $p) {
        $doc->addCard($p);
    }

    $doc->stream();

    $app->setContentDisposition(ResponseHeaderBag::DISPOSITION_INLINE, 'page.pdf');

    return;
});

