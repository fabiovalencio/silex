<?php

require_once __DIR__.'/../bootstrap.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Code\Sistema\Service\ClienteService;
use Code\Sistema\Entity\Cliente;
use Code\Sistema\Mapper\ClienteMapper;


$app['clienteService'] = function (){

    /**
     * @return Cliente
     */
    $clienteEntity = new Cliente();

    /**
     * @return ClienteMapper
     */
    $clienteMapper = new ClienteMapper();

    /**
     * @return ClienteService
     */
    $clienteService = new ClienteService($clienteEntity, $clienteMapper);
    return $clienteService;
};






$app->get("/", function () use ($app) {

    return $app['twig']->render('index.twig', []);

})->bind('home');

$app->get("/ola/{nome}", function ($nome) use ($app) {

    return $app['twig']->render('ola.twig', ['nome' => $nome]);

})->value('nome', 'Cliente');

$app->get("/clientes", function () use ($app) {

    $clientes = $app['clienteService']->fetchAll();
    return $app['twig']->render('clientes.twig', ['clientes' => $clientes]);

})->bind('clientes');

$app->get("/cliente", function () use ($app) {

    $dados['nome'] = 'Cliente';
    $dados['email'] = 'email@cliente.com';

    $result = $app['clienteService']->insert($dados);

    return $app->json($result);

});

$app->run();