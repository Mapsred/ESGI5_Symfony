<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\BattlePet;

class BattlePetFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $battlePet = new BattlePet();

        $battlePet->setName("Idole d’Anubisath");
        $battlePet->setIcon("inv_qirajidol_strife");
        $battlePet->setSpellId(135267);
        $battlePet->setCreatureId(68659);
        $battlePet->setItemId(93040);
        $battlePet->setQualityId(3);
        $battlePet->setBreedId(6);
        $battlePet->setSpeciesId(1155);
        $battlePet->setPetQualityId(3);
        $battlePet->setLevel(25);
        $battlePet->setHealth(1725);
        $battlePet->setPower(276);
        $battlePet->setSpeed(244);
        $battlePet->setBattlePetGuid("000000000BB1CCF9");
        $battlePet->setCreatureName("Idole d’Anubisath");
        $battlePet->setCanBattle(true);
        $manager->persist($battlePet);

        $manager->flush();
    }
}
