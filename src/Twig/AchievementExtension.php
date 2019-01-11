<?php

declare(strict_types=1);

namespace App\Twig;

use App\Utils\BattleNetSDK;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AchievementExtension extends AbstractExtension
{
    /**
     * @var string $battleNetSDK
     */
    private $battleNetSDK;

    /**
     * @param BattleNetSDK $battleNetSDK
     */
    public function __construct(BattleNetSDK $battleNetSDK)
    {
        $this->battleNetSDK = $battleNetSDK;
    }

    /**
     * @return array
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('achievement_label', [$this, 'achievement_label']),
        ];
    }

    /**
     * @param string $id
     * @return string
     */
    public function achievement_label(string $id): string
    {
        $achievement = $this->battleNetSDK->getAchievement($id);

        return $achievement['title'] ?? '';
    }
}
