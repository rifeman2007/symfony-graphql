<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private string $firstName;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private string $lastName;

    public function getId() : int
    {
        return $this->id;
    }

    public function setFirstName(string $firstName) : User
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getFirstName() : string
    {
        return $this->firstName;
    }

    public function setLastName(string $lastName) : User
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getLastName() : string
    {
        return $this->lastName;
    }
}
