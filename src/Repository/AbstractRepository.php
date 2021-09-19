<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * AbstractRepository
 */
abstract class AbstractRepository extends EntityRepository
{
    public function save($entity, $isFlush = true)
    {
        $this->getEntityManager()->persist($entity);

        if ($isFlush) {
            $this->getEntityManager()->flush();
        }
    }    
    
    /**
     * @param type $entity
     */
    public function delete($entity)
    {
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();
    }
}
