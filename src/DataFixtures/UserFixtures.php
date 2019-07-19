<?php


namespace App\DataFixtures;


use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends Fixture
{

    private $usersArray = [
        [
            'firstname' => 'admin',
            'lastname'  => 'admin',
            'password'  => 'admin',
            'email'     => 'admin',
            'roles'     => ["ROLE_ADMIN"],
            'is_active' => 1
        ],
    ];

    public function load(ObjectManager $manager)
    {
        $userRepository = $manager->getRepository(User::class);

        foreach ($this->usersArray as $value)
        {
            if (!$userRepository->findOneBy(['email' => $value['email']])) {
                $user = new User();
                $user->setFirstname($value['firstname']);
                $user->setLastname($value['lastname']);
                $user->setPassword($value['password']);
                $user->setEmail($value['email']);
                $user->setRoles($value['roles']);
                $user->setIsActive($value['is_active']);

                $manager->persist($user);
            }
        }

        $manager->flush();
    }

}
