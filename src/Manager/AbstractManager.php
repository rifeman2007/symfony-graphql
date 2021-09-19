<?php

namespace App\Manager;

use App\Repository\AbstractRepository;

abstract class AbstractManager
{
    protected $repository;

    public function createNew()
    {
        $class = $this->getClass();

        return new $class();
    }

    public function getFindAll()
    {
        return $this->repository->findAll();
    }

    public function getFindByLimit($limit)
    {
        return $this->repository->findByLimit($limit);
    }

    public function getFind($id)
    {
        return $this->repository->find($id);
    }

    public function save($entity)
    {
        return $this->repository->save($entity);
    }

    public function delete($entity)
    {
        $this->repository->delete($entity);
    }

    abstract public function getClass();
}