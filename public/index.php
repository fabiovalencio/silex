<?php

require_once __DIR__.'/../bootstrap.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Code\Sistema\Service\ClienteService;
use Code\Sistema\Entity\Cliente;
use Code\Sistema\Mapper\ClienteMapper;


$app['clienteService'] = function () use ($em){

    $clienteEntity = new Cliente();
    $clienteMapper = new ClienteMapper($em);
    $clienteService = new ClienteService($clienteEntity, $clienteMapper);

    return $clienteService;
};


$app->get("/api/clientes", function () use ($app) {

    $clientes = $app['clienteService']->fetchAll();

    return $app->json( $clientes );

});

$app->get("/api/clientes/{id}", function ($id) use ($app) {

    $cliente = $app['clienteService']->find($id);
    return $app->json( $cliente );

});

$app->post("/api/cliente", function (Request $request) use ($app) {

    $dados['nome'] = $request->request->get('nome');
    $dados['email'] = $request->get('email');

    $result = $app['clienteService']->insert($dados);

    return $app->json($result);

})->bind('api/cliente');

$app->put("/api/clientes/{id}", function ($id, Request $request) use ($app) {

    $dados['nome'] = $request->request->get('nome');
    $dados['email'] = $request->request->get('email');


    $clientes = $app['clienteService']->update($id, $dados);
    return $app->json( $clientes );

});

$app->delete("/api/cliente/{id}", function ($id) use ($app) {

    $clientes = $app['clienteService']->delete($id);
    return $app->json( $clientes );

});








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