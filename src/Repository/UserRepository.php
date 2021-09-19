<?php

namespace App\Repository;

class UserRepository extends AbstractRepository
{
    public function findByLimit($limit)
    {
        return $this->findBy(
            [],
            ['id' => 'DESC'],
            $limit,
            0
        );
    }
}