<?php


namespace App\Services;


use App\Entity\User;
use App\Repository\UserRepository;

class UserService
{
    private $userRepository;

    /**
     * UserService constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @return array
     */
    public function getList()
    {
        return $this->userRepository->findAll();
    }

    /**
     * @param User $user
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function saveItem(User $user)
    {
        $this->userRepository->save($user);
    }

    /**
     * @param User $user
     * @throws \Doctrine\ORM\ORMException
     */
    public function removeItem(User $user)
    {
        $this->userRepository->delete($user);
    }
}
