<?php

declare(strict_types=1);

namespace App\GraphQL\Resolver;

use App\Entity\User;
use App\Manager\UserManager;
use Overblog\GraphQLBundle\Definition\Argument;

class UserResolver
{
    /**
     * @var UserManager
     */
    protected $userManager;

    /**
     * UserResolver constructor.
     *
     * @param UserManager $userManager
     */
    public function __construct(UserManager $userManager)
    {
        $this->userManager = $userManager;
    }

    /**
     * @param Argument $args
     */
    public function find(Argument $args): User
    {
        return $this->userManager->getFind($args['id']);
    }    

    /**
     * @param Argument $args
     */
    public function findAll(Argument $args): array
    {
        $limit = isset($args['limit'])? $args['limit']: 20;

        return $this->userManager->getFindByLimit($limit);
    }    

    /**
     * @param Argument $args
     */
    public function save(Argument $args): User
    {
        $user = $this->userManager->createNew();
        
        $user->setFirstName($args['first_name']);
        $user->setLastName($args['last_name']);

        try {
            $this->userManager->save($user);
        } catch (\Exception $e) {
            throw new UserError(sprintf('Could not save user. Retry later'));
        }

        return $user;
    }

    /**
     * @param Argument $args
     */
    public function update(Argument $args): User
    {
        $user = $this->userManager->getFind($args['id']);
        
        $user->setFirstName($args['first_name']);
        $user->setLastName($args['last_name']);

        try {
            $this->userManager->save($user);
        } catch (\Exception $e) {
            throw new UserError(sprintf('Could not save user with id "%s". Retry later', $id));
        }

        return $user;
    }

    /**
     * @param Argument $args
     */
    public function delete(Argument $args): array
    {
        $user = $this->userManager->getFind($args['id']);

        try {
            $this->userManager->delete($user);
        } catch (\Exception $e) {
            throw new UserError(sprintf('Could not delete user with id "%s". Retry later', $id));
        }

        return $this->userManager->getFindAll();
    }
}