<?php

require_once __DIR__.'/../bootstrap.php';

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

$app->get("/", function () {

    echo("Olá mundo!");

});

$arrayClientes = [
    [
        "id" => 1,
        "nome" => "Jõao",
        "email" => "joao@email.com",
        "cpf" => "12.345.678-9"
    ],
    [
        "id" => 1,
        "nome" => "Pedro",
        "email" => "pedro@email.com",
        "cpf/cnpj" => "22.654.678-6"
    ],
    [
        "id" => 1,
        "nome" => "Mateus",
        "email" => "mateus@email.com",
        "cpf/cnpj" => "33.765.678-3"
    ],
    [
        "id" => 1,
        "nome" => "José",
        "email" => "jose@empresa.com",
        "cpf/cnpj" => "414.654.678.0001-7"
    ],
    [
        "id" => 1,
        "nome" => "Marcos",
        "email" => "marcos@empresa2.com",
        "cpf/cnpj" => "07.255.543.0001-32"
    ]
];

$app->get("/clientes", function () use ($app, $arrayClientes) {

    return $app->json($arrayClientes, 200);

});

$app->get("/cliente", function () use ($app) {

    $dados['nome'] = 'Cliente';
    $dados['email'] = 'email@cliente.com';

    $result = $app['clienteService']->insert($dados);

    return $app->json($result);

});

$app->run();