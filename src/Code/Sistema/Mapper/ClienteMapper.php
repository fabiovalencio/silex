<?php

namespace Code\Sistema\Mapper;

use Code\Sistema\Entity\Cliente;

class ClienteMapper
{
    private $dados = [

        0 => [
            'id' => 1,
            'nome' => 'Cliente X',
            'email' => 'clientex@cliente.com'
        ],
        1 => [
            'id' => 2,
            'nome' => 'Cliente Y',
            'email' => 'clientey@cliente.com'
        ],
        2 => [
            'id' => 3,
            'nome' => 'Cliente Z',
            'email' => 'clientez@cliente.com'
        ]
    ];

    public function insert(Cliente $cliente)
    {
        return [
            'nome' => $cliente->getNome(),
            'email' => $cliente->getEmail()
        ];
    }

    public function fetchAll()
    {
        $dados = $this->dados;
        return $dados;
    }

    public function find($id)
    {
        $result = $this->busca($this->dados, $id);
        return $result;
    }

    private function busca($array, $id){
        foreach($array as $key => $value){
            if ($value['id'] == $id){
                return $value;
            }
        }
        return null;
    }
}