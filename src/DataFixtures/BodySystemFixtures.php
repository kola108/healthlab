<?php

namespace App\DataFixtures;

use App\Entity\BodySystem;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class BodySystemFixtures extends Fixture
{
    private $systemsArray = [
        'сердечно-сосудистая',
        'центральная нервная',
        'пищеварительная',
        'мочевыделительная',
        'половая'
    ];

    public function load(ObjectManager $manager)
    {
        $bodySystemRepository = $manager->getRepository(BodySystem::class);

        foreach ($this->systemsArray as $value)
        {
            if (!$bodySystemRepository->findOneBy(['name' => $value])) {
                $bodySystem = new BodySystem();
                $bodySystem->setName($value);
                $manager->persist($bodySystem);
            }
        }

        $manager->flush();
    }
}
