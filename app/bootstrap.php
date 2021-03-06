<?php
/*
 * BOOTSTRAP THE APP
 */

/*
 * Configuration
 */
date_default_timezone_set('America/Los_Angeles');
error_reporting(E_ALL);
ini_set( 'display_errors','1');

/*
 * Autoload Composer
 */
require_once __DIR__ . '/vendor/autoload.php';

/*
 * Namespace Aliases
 */
use Symfony\Component\Templating\PhpEngine;
use Symfony\Component\Templating\TemplateNameParser;
use Symfony\Component\Templating\Loader\FilesystemLoader;

/*
 * Templating Engine
 */
$loader = new FilesystemLoader(__DIR__ . '/views/%name%');
$templating = new PhpEngine(new TemplateNameParser(), $loader);

/*
 * Application Bootup
 */
$app = new Silex\Application();

/*
 * Logging
 */
$app->register(new Silex\Provider\MonologServiceProvider(), array(
    'monolog.logfile' => __DIR__.'/development.log',
    'monolog.name' => 'otpp',
));

$app['monolog'] = $app->share($app->extend('monolog', function($monolog, $app){
    $syslogHandler = new \Monolog\Handler\SyslogHandler('otpp', 'user', \Monolog\Logger::DEBUG);
    $monolog->setHandlers(array($syslogHandler));
    return $monolog;
}));

/*
 * Controllers
 */
require_once __DIR__ . '/controllers.php';

/*
 * Run the Application
 */
$app->run();