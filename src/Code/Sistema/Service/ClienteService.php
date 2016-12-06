<?php

namespace Code\Sistema\Service;

use Code\Sistema\Entity\Cliente;
use Code\Sistema\Mapper\ClienteMapper;

class ClienteService
{
    private $cliente;
    private $clienteMapper;

    public function __construct(Cliente $cliente, ClienteMapper $clienteMapper)
    {
        $this->cliente = $cliente;
        $this->clienteMapper = $clienteMapper;
    }

    public function insert(array $data)
    {
        $clienteEntity = $this->cliente;
        $clienteEntity->setNome($data['nome']);
        $clienteEntity->setEmail($data['email']);

        $mapper = $this->clienteMapper;
        $result = $mapper->insert($clienteEntity);

        return $result;
    }

    public function fetchAll()
    {
        return $this->clienteMapper->fetchAll();
    }

    public function find($id)
    {
        return $this->clienteMapper->find($id);
    }
}