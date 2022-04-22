<?php

namespace App\DataFixtures;

use App\Entity\FightingStyle;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FightingStyleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $fs = new FightingStyle();
        $fs->setDescription("Balanced Fighting Style does not bring modifiers");
        $fs->setName("Balanced Style");
        $fs->setModifiers([]);
        $fs->setRequirements([]);
        $manager->persist($fs);

        $fs = new FightingStyle();
        $fs->setDescription("Offensive Fighting Style increase Attack Ratio also decrease Defense Ratio");
        $fs->setName("Offensive Style");
        $fs->setModifiers(["AR"=>1,"DR"=>-1]);
        $fs->setRequirements([]);
        $manager->persist($fs);

        $fs = new FightingStyle();
        $fs->setDescription("Defensive Fighting Style increase Defense Ratio also decrease Attack Ratio");
        $fs->setName("Defensive Style");
        $fs->setModifiers(["AR"=>-1,"DR"=>1]);
        $fs->setRequirements([]);
        $manager->persist($fs);

        $manager->flush();
    }
}
