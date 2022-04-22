<?php

namespace App\DataFixtures;

use App\Entity\Breed;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BreedFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $breed = new Breed();
        $breed->setName('Human');
        $breed->setDescription('Humans are able to do plenty of things, they are well-balanced');
        $breed->setModifiers([]);
        $manager->persist($breed);

        $breed = new Breed();
        $breed->setName('Dwarf');
        $breed->setDescription('Dwarves are hard at work, they balance their weak speed by a superior stamina');
        $breed->setModifiers(["SPE"=>-1, "STA"=>+1]);
        $manager->persist($breed);

        $breed = new Breed();
        $breed->setName('Elf');
        $breed->setDescription('Elves are not so endurant, but their speed and dexterity are mythical');
        $breed->setModifiers(["SPE"=>1, "STA"=>-2, "DEX"=>1]);
        $manager->persist($breed);


        $manager->flush();
    }
}
