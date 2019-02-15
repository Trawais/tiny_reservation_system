<?php

namespace App\DataFixtures;

use App\Entity\ReservationSlot;
use App\Entity\Sport;
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
        $sportAgility = new Sport();
        $sportAgility->setName("Agility");

        $sportHoopers = new Sport();
        $sportHoopers->setName("Hoopers");

        $timestamp = strtotime("+ 5 day");
        $date = new \DateTime();
        $date->setTimestamp($timestamp);

        $slot = new ReservationSlot();
        $slot->setDate($date);
        $slot->setCapacity(8);
        $slot->setSport($sportAgility);

        $manager->persist($sportAgility);
        $manager->persist($sportHoopers);
        $manager->persist($slot);
        $manager->flush();
    }
}
