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
        $sport = new Sport();
        $sport->setName("Agility");

        $timestamp = strtotime("+ 5 day");
        $date = new \DateTime();
        $date->setTimestamp($timestamp);

        $slot = new ReservationSlot();
        $slot->setDate($date);
        $slot->setCapacity(8);
        $slot->setSport($sport);

        $manager->persist($sport);
        $manager->persist($slot);
        $manager->flush();
    }
}
