<?php
/**
 * Created by PhpStorm.
 * User: fabiovalencio
 * Date: 12/9/16
 * Time: 3:46 PM
 */

namespace Code\Sistema\Entity;


use Doctrine\ORM\EntityRepository;

class ClienteRepository extends EntityRepository
{
    public function getClientesAsc()
    {
        return $this
            ->createQueryBuilder("c")
            ->orderBy("c.nome", "asc")
            ->getQuery()
            ->getResult();
    }

    public function getClienteDesc()
    {
        $dql = "SELECT c FROM Code\sistema\Entity\Cliente c ORDER BY c.nome DESC";

        return $this
            ->getEntityManager()
            ->createQuery($dql)
            ->getResult();
    }
}