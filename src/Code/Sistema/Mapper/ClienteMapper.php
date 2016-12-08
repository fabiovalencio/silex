<?php

namespace Code\Sistema\Mapper;

use Code\Sistema\Entity\Cliente;
use Doctrine\ORM\EntityManager;

class ClienteMapper
{

    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function insert(Cliente $cliente)
    {
        $this->em->persist($cliente);
        $this->em->flush();

        return [
            'success' => true,
            'id' => $cliente->getId(),
            'nome' => $cliente->getNome(),
            'email' => $cliente->getEmail()
        ];
    }

    public function fetchAll()
    {
        $repo = $this->em->getRepository('Code\Sistema\Entity\Cliente');
        $dados = $repo->findAll();

        return $dados;
    }

    public function find($id)
    {
        $result = $this->repo->find($id);
        return $result;
    }

    public function update($id, array $data)
    {

        $result = $this->repofind($id);

        $nome = $data['nome'] ? $data['nome'] : $result->getNome();
        $email = $data['email'] ? $data['email'] : $result->getEmail();

        $result->setNome($nome);
        $result->setEmail($email);

        $this->em->flush();

        return $result;
    }

    public function delete($id)
    {
        $result = $this->repo->find($id);
        $result->remove($result);

        return ['success' => true];
    }

}