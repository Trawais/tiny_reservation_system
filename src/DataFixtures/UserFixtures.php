<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }


    public function load(ObjectManager $manager)
    {
        $adminUser = new User();
        $adminUser->setUsername('admin');
        $adminUser->setRoles(["ROLE_ADMIN"]);
        $adminUser->setPassword(
            $this->encoder->encodePassword($adminUser, '1234')
        );

        $user = new User();
        $user->setUsername('user');
        $user->setPassword(
            $this->encoder->encodePassword($user, '1234')
        );

        $manager->persist($adminUser);
        $manager->persist($user);
        $manager->flush();
    }
}
