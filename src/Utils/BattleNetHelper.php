<?php

namespace App\Utils;

use GuzzleHttp\Exception\ClientException;

class BattleNetHelper
{
    /** @var BattleNetSDK $battleNetSDK */
    private $battleNetSDK;

    /**
     * BattleNetHelper constructor.
     * @param BattleNetSDK $battleNetSDK
     */
    public function __construct(BattleNetSDK $battleNetSDK)
    {
        $this->battleNetSDK = $battleNetSDK;
    }

    /**
     * @return BattleNetSDK
     */
    public function getBattleNetSDK(): BattleNetSDK
    {
        return $this->battleNetSDK;
    }

    /**
     * @return array
     */
    public function getRealms(): array
    {
        $content = $this->getBattleNetSDK()->getRealms();
        $realms = $content['realms'];

        return array_combine(array_column($realms, 'name'), array_column($realms, 'slug'));
    }

    /**
     * @param string $player
     * @param string $realm
     * @param bool $format
     * @return array|null
     */
    public function findCharacter(string $player, string $realm, bool $format = true): array
    {
        try {
            $contents = $this->getBattleNetSDK()->getCharacter($player, $realm);
            $stats = $this->getBattleNetSDK()->getCharacter($player, $realm, 'stats');
            $contents['stats'] = $stats['stats'];

            return $format ? $this->formatCharacter($contents) : $contents;
        } catch (ClientException $e) {
            $contents = json_decode($e->getResponse()->getBody()->getContents(), true);
            if (isset($contents['reason']) && $contents['reason'] === 'Character not found.') {
                return null;
            }

            throw $e;
        }
    }

    /**
     * @param string $player
     * @param string $realm
     * @param bool $format
     * @return array|null
     */
    public function findCharacterItems(string $player, string $realm, bool $format = true): array
    {
        try {
            $contents = $this->getBattleNetSDK()->getCharacter($player, $realm, 'items');

            return $format ? $this->formatCharacterItems($contents)['items'] : $contents['items'];
        } catch (ClientException $e) {
            $contents = json_decode($e->getResponse()->getBody()->getContents(), true);
            if (isset($contents['reason']) && $contents['reason'] === 'Character not found.') {
                return null;
            }

            throw $e;
        }
    }

    /**
     * @param array $character
     * @return array
     */
    public function formatCharacter(array $character): array
    {
        $character['thumbnail'] = sprintf('http://render-eu.worldofwarcraft.com/character/%s', $character['thumbnail']);
        $character['main_background'] = str_replace('-avatar', '-main', $character['thumbnail']);
        $image = imagecreatefromjpeg($character['main_background']);
        $image_size = (object)[
            'width' => imagesx($image),
            'height' => imagesy($image)
        ];
        $rgb = imagecolorat($image, round($image_size->width / 2), $image_size->height - 1);
        $r = ($rgb >> 16) & 0xFF;
        $g = ($rgb >> 8) & 0xFF;
        $b = $rgb & 0xFF;

        $character['main_color'] = ['r' => $r, 'g' => $g, 'b' => $b];

        $classes = $this->getBattleNetSDK()->getCharacterClasses();
        if (false !== $key = array_search($character['class'], array_column($classes['classes'], 'id'))) {
            $character['class'] = $classes['classes'][$key];
        }

        $races = $this->getBattleNetSDK()->getCharacterRaces();
        if (false !== $key = array_search($character['race'], array_column($races['races'], 'id'))) {
            $character['race'] = $races['races'][$key];
        }

        return $character;
    }

    /**
     * @param array $character
     * @return array
     */
    public function formatCharacterItems(array $character): array
    {

        foreach ($character['items'] as $key => $item) {
            if (isset($item['icon'])) {
                $character['items'][$key]['image'] = [
                    'small' => sprintf('https://wow.zamimg.com/images/wow/icons/small/%s.jpg', $item['icon']),
                    'medium' => sprintf('https://wow.zamimg.com/images/wow/icons/medium/%s.jpg', $item['icon']),
                    'large' => sprintf('https://wow.zamimg.com/images/wow/icons/large/%s.jpg', $item['icon'])
                ];
            }
        }

        return $character;
    }
}