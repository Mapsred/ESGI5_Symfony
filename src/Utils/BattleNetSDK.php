<?php

namespace App\Utils;

use GuzzleHttp\Client;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class BattleNetSDK
{
    /** @var Client $client */
    private $client;

    /** @var string $client_id */
    private $client_id;

    /** @var string $client_secret */
    private $client_secret;

    /** @var SessionInterface $session */
    private $session;

    /** @var FilesystemAdapter $cacheManager */
    private $cacheManager;

    const LONG_TIME = 86400; //1 day to seconds
    const SHORT_TIME = 600; //10 minutes to seconds

    /**
     * BattleNetSDK constructor.
     * @param string $client_id
     * @param string $client_secret
     * @param CacheItemPoolInterface $cacheManager
     * @param Client $client
     * @param SessionInterface $session
     */
    public function __construct(
        string $client_id,
        string $client_secret,
        CacheItemPoolInterface $cacheManager,
        Client $client,
        SessionInterface $session
    ) {
        $this->client = $client;
        $this->client_id = $client_id;
        $this->client_secret = $client_secret;
        $this->session = $session;
        $this->cacheManager = $cacheManager;
    }

    /**
     * @return array
     */
    public function getRealms(): array
    {
        return $this->cacheHandle(function () {
            $response = $this->client->request('GET', '/data/wow/realm/', [
                'query' => [
                    'namespace' => 'dynamic-eu',
                    'locale' => 'fr_FR',
                    'access_token' => $this->getAccessToken()
                ]
            ]);

            return $this->getJsonContent($response);
        }, 'realms', self::LONG_TIME);
    }

    /**
     * @param string $slug
     * @return array
     */
    public function getRealm(string $slug): array
    {
        return $this->cacheHandle(function () use ($slug) {
            $response = $this->client->request('GET', sprintf('/data/wow/realm/%s', $slug), [
                'query' => [
                    'namespace' => 'dynamic-eu',
                    'locale' => 'fr_FR',
                    'access_token' => $this->getAccessToken()
                ]
            ]);

            return $this->getJsonContent($response);
        }, sprintf('realm_%s', $slug), self::LONG_TIME);
    }

    /**
     * @param string $name
     * @param string $realm
     * @param string|null $fields
     * @return array
     */
    public function getCharacter(string $name, string $realm, string $fields = null): array
    {
        return $this->cacheHandle(function () use ($name, $realm, $fields) {
            $response = $this->client->request('GET', sprintf('/wow/character/%s/%s', $realm, $name), [
                'query' => [
                    'region' => 'eu',
                    'fields' => $fields,
                    'locale' => 'fr_FR',
                    'access_token' => $this->getAccessToken()
                ]
            ]);

            return $this->getJsonContent($response);
        }, sprintf('character_%s_%s_%s', $realm, $name, $fields), self::SHORT_TIME);
    }

    /**
     * @param string $id
     * @return mixed
     */
    public function getAchievement(string $id): array
    {
        return $this->cacheHandle(function () use ($id) {
            $response = $this->client->request('GET', sprintf('/wow/achievement/%s', $id), [
                'query' => [
                    'region' => 'eu',
                    'locale' => 'fr_FR',
                    'access_token' => $this->getAccessToken()
                ]
            ]);

            return $this->getJsonContent($response);
        }, sprintf('achievement_%s', $id), self::LONG_TIME);
    }

    public function getAchievements(int $factionId): array
    {
        return $this->cacheHandle(function () use ($factionId) {
            $response = $this->client->request('GET', '/wow/data/character/achievements', [
                'query' => [
                    'region' => 'eu',
                    'locale' => 'fr_FR',
                    'access_token' => $this->getAccessToken()
                ]
            ]);

            $content = $this->getJsonContent($response)['achievements'] ?? [];

            $output = [];
            foreach ($content as $item) {
                $achievements = $item['achievements'] ?? [];

                $categogiesAchievements = array_column($item['categories'] ?? [], 'achievements');

                foreach ($categogiesAchievements as $categogiesAchievement) {
                    $achievements = array_merge($achievements, $categogiesAchievement);
                }

                foreach ($achievements as $achievement) {
                    if (!in_array($achievement['factionId'], [$factionId, 2])) {
                        continue;
                    }

                    $output[$achievement['id']] = [
                        'title' => $achievement['title'],
                        'category' => $item['name']
                    ];
                }
            };

            return $output;
        }, 'achievements', self::SHORT_TIME);
    }

    /**
     * @return array
     */
    public function getCharacterClasses(): array
    {
        return $this->cacheHandle(function () {
            $response = $this->client->request('GET', '/wow/data/character/classes', [
                'query' => [
                    'region' => 'eu',
                    'locale' => 'fr_FR',
                    'access_token' => $this->getAccessToken()
                ]
            ]);

            return $this->getJsonContent($response);
        }, 'character_classes', self::LONG_TIME);
    }

    /**
     * @return array
     */
    public function getCharacterRaces(): array
    {
        return $this->cacheHandle(function () {
            $response = $this->client->request('GET', '/wow/data/character/races', [
                'query' => [
                    'region' => 'eu',
                    'locale' => 'fr_FR',
                    'access_token' => $this->getAccessToken()
                ]
            ]);

            return $this->getJsonContent($response);
        }, 'character_races', self::LONG_TIME);
    }

    /**
     * @return string
     */
    private function generateAccessToken(): string
    {
        $response = $this->client->request("POST", "https://eu.battle.net/oauth/token", [
            'form_params' => ['grant_type' => 'client_credentials'],
            'auth' => [$this->client_id, $this->client_secret]
        ]);

        $data = json_decode($response->getBody()->getContents(), true);

        $this->session->set('access_token', [
            'access_token' => $data['access_token'],
            'expires_at' => (new \DateTime())->add(new \DateInterval(sprintf("PT%sS", $data['expires_in'])))
        ]);

        return $this->session->get('access_token')['access_token'];
    }

    /**
     * @return string
     */
    private function getAccessToken(): string
    {
        if (!$this->session->has('access_token') || $this->session->has('access_token')['expires_at'] <= new \DateTime()) {
            return $this->generateAccessToken();
        }

        return $this->session->get('access_token')['access_token'];
    }

    /**
     * @param ResponseInterface $response
     * @return array
     */
    private function getJsonContent(ResponseInterface $response): array
    {
        $this->verifyStatus($response);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @param ResponseInterface $response
     * @param int $code
     */
    private function verifyStatus(ResponseInterface $response, int $code = 200): void
    {
        if ($response->getStatusCode() != $code) {
            throw new \Exception("Error");
        }
    }

    /**
     * @param callable $callback
     * @param string $itemName
     * @param int $expiresAfter
     * @return mixed
     */
    private function cacheHandle(callable $callback, string $itemName, int $expiresAfter = 600)
    {
        $cacheContent = $this->cacheManager->getItem($itemName);
        if ($cacheContent->isHit()) {
            return $cacheContent->get();
        }

        $this->cacheManager->save($cacheContent->expiresAfter($expiresAfter)->set($callback()));

        return $cacheContent->get();
    }
}