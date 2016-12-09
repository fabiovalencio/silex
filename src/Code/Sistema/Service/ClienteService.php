<?php

namespace Code\Sistema\Service;

use Code\Sistema\Entity\Cliente as ClienteEntity;
use Code\Sistema\Entity\ClienteRepository;
use Doctrine\ORM\EntityManager;

//FACADE
class ClienteService
{
    /**
     * @var EntityManager
     */
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function insert(array $data)
    {
        $clienteEntity = new ClienteEntity();
        $clienteEntity->setNome($data['nome']);
        $clienteEntity->setEmail($data['email']);

        $this->em->persist($clienteEntity);
        $this->em->flush();

        return $clienteEntity;
    }

    public function fetchAll()
    {
        /**
         * @var ClienteRepository $repo
         */
        $repo = $this->em->getRepository("Code\Sistema\Entity\Cliente");
        $result = $repo->getClientesAsc();

        return $result;
    }

    public function find($id)
    {
        $cliente = $this->em->getReference("Code\Sistema\Entity\Cliente", $id);

        return $cliente;
    }

    public function update($id, array $array)
    {
        $cliente = $this->em->getReference("Code\Sistema\Entity\Cliente", $id);

        $cliente->setNome($array['nome']);
        $cliente->setEmail($array['email']);

        $this->em->persist($cliente);
        $this->em->flush();

        return $cliente;
    }

    public function delete($id)
    {
        $cliente = $this->em->getReference("Code\Sistema\Entity\Cliente", $id);

        $this->em->remove($cliente);
        $this->em->flush();

        return true;
    }
}