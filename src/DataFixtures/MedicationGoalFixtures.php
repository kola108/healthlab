<?php

namespace App\DataFixtures;

use App\Entity\MedicationGoal;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class MedicationGoalFixtures extends Fixture
{
    private $systemsArray = [
        'противовирусное лечение',
        'противоонкологическое лечение',
        'профилактика'
    ];

    public function load(ObjectManager $manager)
    {
        $bodySystemRepository = $manager->getRepository(MedicationGoal::class);

        foreach ($this->systemsArray as $value)
        {
            if (!$bodySystemRepository->findOneBy(['name' => $value])) {
                $bodySystem = new MedicationGoal();
                $bodySystem->setName($value);
                $manager->persist($bodySystem);
            }
        }

        $manager->flush();
    }
}
