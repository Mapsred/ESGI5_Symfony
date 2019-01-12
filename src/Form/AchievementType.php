<?php

declare(strict_types=1);

namespace App\Form;

use App\Utils\BattleNetSDK;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AchievementType extends AbstractType
{
    /**
     * @var BattleNetSDK $battleNetSDK
     */
    private $battleNetSDK;

    /**
     * AchievementType constructor.
     * @param BattleNetSDK $battleNetSDK
     */
    public function __construct(BattleNetSDK $battleNetSDK)
    {
        $this->battleNetSDK = $battleNetSDK;
    }

    /**
     * @param OptionsResolver $resolver
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setRequired(['username', 'realm']);

        $choices = function (Options $options) {
            $character = $this->battleNetSDK->getCharacter($options['username'], $options['realm'], 'achievements');

            $completed = array_flip($character['achievements']['achievementsCompleted'] ?? []);
            $achievements = $this->battleNetSDK->getAchievements($character['faction']);

            $remaining = array_diff_key($achievements, $completed);
            $remaining = array_flip($remaining);

            ksort($remaining);

            return $remaining;
        };

        $resolver->setDefault('choices', $choices);
    }

    /**
     * @return string
     */
    public function getParent(): string
    {
        return ChoiceType::class;
    }
}
