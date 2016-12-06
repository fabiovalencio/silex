<?php

use Silex\Provider\SwiftmailerServiceProvider;

use Silex\Provider\SecurityServiceProvider;
use Symfony\Component\HttpFoundation\Session\Session;

use Symfony\Component\Security\Core\AuthenticationEvents;
use Symfony\Component\Security\Core\Event\AuthenticationEvent;
use Symfony\Component\Security\Http\SecurityEvents;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Security\Http\Event\SwitchUserEvent;

require_once 'vendor/autoload.php';
require_once 'doctrineConfig.php';

//start application
$app = new Silex\Application();
$app['debug'] = true;

//provider session
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());
$app->register(new Silex\Provider\SessionServiceProvider());
//start session
$app['session'] = $app->share(function ($app) {
    return new Session();
});
$app['session']->start();

//register twig path
$app->register(new Silex\Provider\TwigServiceProvider(),array(
    'twig.path' => __DIR__ . '/views',
));

return $app;