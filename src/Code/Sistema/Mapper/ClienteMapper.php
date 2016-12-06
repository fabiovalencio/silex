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

    public function update($id, array $data)
    {
        $result = $this->busca($this->dados, $id);

        $result['nome'] = $data['nome'] ? $data['nome'] : $result['nome'];
        $result['email'] = $data['email'] ? $data['email'] : $result['email'];

        return $result;
    }

    public function delete($id)
    {
        unset($this->dados[$id]);
        return ['success' => true];
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