<?php

require_once __DIR__.'/../bootstrap.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Code\Sistema\Service\ClienteService;


$app['clienteService'] = function () use ($em){

    $clienteService = new ClienteService($em);
    return $clienteService;
};


################################### A P I ######################################
$app->get("/api/clientes", function () use ($app) {

    $clientes = $app['clienteService']->fetchAll();

    return $app->json($clientes);

});

$app->get("/api/clientes/{id}", function ($id) use ($app) {

    $cliente = $app['clienteService']->find($id);
    return $app->json( $cliente );

});

$app->post("/api/cliente", function (Request $request) use ($app) {

    $dados['nome'] = $request->request->get('nome');
    $dados['email'] = $request->request->get('email');

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




################################### W E B ######################################
$app->get("/", function () use ($app) {

    return $app['twig']->render('index.twig', []);

})->bind('home');

$app->get("/clientes", function () use ($app) {

    $clientes = $app['clienteService']->fetchAll();
    return $app['twig']->render('clientes.twig', ['clientes' => $clientes]);

})->bind('clientes');

$app->get("/cliente/create", function () use ($app) {

    return $app['twig']->render('cliente-create.twig', []);

})->bind('cliente/create');

$app->post("/cliente-create", function (Request $request) use ($app) {

    $dados['nome'] = $request->request->get('nome');
    $dados['email'] = $request->request->get('email');

    try{
        $app['clienteService']->insert($dados);
    } catch (ErrorException $e){
        var_dump($e);
    }

    return $app->redirect($app['url_generator']->generate('clientes'));

})->bind('cliente-create');

$app->get("/cliente/update/{id}", function ($id) use ($app) {

    $cliente = $app['clienteService']->find($id);
    return $app['twig']->render('cliente-update.twig', ['cliente' => $cliente]);

})->bind('cliente/update');

$app->post("/cliente-update/{id}", function (Request $request, $id) use ($app) {

    $dados['nome'] = $request->request->get('nome');
    $dados['email'] = $request->request->get('email');

    try{
        $app['clienteService']->update($id, $dados);
    } catch (ErrorException $e){
        var_dump($e);
    }

    return $app->redirect($app['url_generator']->generate('clientes'));

})->bind('cliente-update');

$app->delete("/cliente/delete/{id}", function ($id) use ($app) {

    $clientes = $app['clienteService']->delete($id);
    return $app->json( $clientes );

})->bind('cliente/delete');

$app->run();