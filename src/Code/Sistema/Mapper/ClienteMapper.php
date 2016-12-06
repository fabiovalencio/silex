<?php

namespace Code\Sistema\Mapper;

use Code\Sistema\Entity\Cliente;

class ClienteMapper
{
    public function insert(Cliente $cliente)
    {
        return [
            'nome' => $cliente->getNome(),
            'email' => $cliente->getEmail()
        ];
    }

}