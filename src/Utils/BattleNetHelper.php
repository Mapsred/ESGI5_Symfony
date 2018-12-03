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
    public function getRealms()
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
    public function findCharacter(string $player, string $realm, bool $format = true)
    {
        try {
            $contents = $this->getBattleNetSDK()->getCharacter($player, $realm);

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
     * @param array $character
     * @return array
     */
    public function formatCharacter(array $character)
    {
        $character['thumbnail'] = sprintf('http://render-eu.worldofwarcraft.com/character/%s', $character['thumbnail']);
        $classes = $this->getBattleNetSDK()->getCharacterClasses();

        if (false !== $key = array_search($character['class'], array_column($classes['classes'], 'id'))) {
            $character['class'] = $classes['classes'][$key];
        }

        return $character;
    }
}