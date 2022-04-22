<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail('mathieu.helary@gmail.com');
        $user->setRoles(['ROLE_USER','ROLE_ADMIN']);
        $user->setSurname('DCD');
        $user->setPassword("123456789");
        $manager->persist($user);

        $user = new User();
        $user->setEmail('guest@guest.fr');
        $user->setRoles(['ROLE_USER']);
        $user->setSurname('Guest1');
        $user->setPassword("123456789");
        $manager->persist($user);

        $manager->flush();
    }
}
