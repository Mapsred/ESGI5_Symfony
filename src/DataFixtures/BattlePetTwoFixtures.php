<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\BattlePet;

class BattlePetTwoFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $battlePet = new BattlePet();

        $battlePet->setName("Idole d’Anubis");
        $battlePet->setIcon("inv_idol_strife");
        $battlePet->setSpellId(135267);
        $battlePet->setCreatureId(68660);
        $battlePet->setItemId(93040);
        $battlePet->setQualityId(3);
        $battlePet->setBreedId(6);
        $battlePet->setSpeciesId(1155);
        $battlePet->setPetQualityId(3);
        $battlePet->setLevel(25);
        $battlePet->setHealth(1725);
        $battlePet->setPower(280);
        $battlePet->setSpeed(245);
        $battlePet->setBattlePetGuid("000000000BB1CCF8");
        $battlePet->setCreatureName("Idole d’Anubis");
        $battlePet->setCanBattle(true);
        $manager->persist($battlePet);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            BattlePet::class,
        );
    }
}
