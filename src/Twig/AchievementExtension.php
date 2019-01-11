<?php

namespace App\Twig;

use App\Utils\BattleNetSDK;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AchievementExtension extends AbstractExtension
{
    /**
     *
     */
    private $battleNetSDK;

    /**
     * AchievementExtension constructor.
     * @param BattleNetSDK $battleNetSDK
     */
    public function __construct(BattleNetSDK $battleNetSDK)
    {
        $this->battleNetSDK = $battleNetSDK;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('achievement_label', [$this, 'achievement_label']),
        ];
    }

    public function achievement_label($id)
    {
        $achievement = $this->battleNetSDK->getAchievement($id);

        return $achievement['title'] ?? '';
    }
}
