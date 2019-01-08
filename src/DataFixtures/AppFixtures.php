<?php

namespace App\DataFixtures;

use App\Entity\ReservationSlot;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     * @throws \Exception
     */
    public function load(ObjectManager $manager)
    {
        $timestamp = strtotime("+ 5 day");
        $date = new \DateTime();
        $date->setTimestamp($timestamp);

        $slot = new ReservationSlot();
        $slot->setDate($date);
        $slot->setCapacity(8);

        $manager->persist($slot);
        $manager->flush();
    }
}
