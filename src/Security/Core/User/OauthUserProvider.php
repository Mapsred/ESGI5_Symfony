<?php
/**
 * Created by PhpStorm.
 * User: kuben
 * Date: 18/10/2018
 * Time: 22:07
 */

namespace App\Security\Core\User;

use App\Entity\BnetOauthUser;
use Doctrine\Common\Persistence\ObjectManager;
use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use HWI\Bundle\OAuthBundle\Security\Core\User\OAuthUserProvider as BaseOauthUserProvider;

class OauthUserProvider extends BaseOauthUserProvider
{

    /**
     * @var ObjectManager manager
     */
    private $manager;


    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    private function generateBnetOauthUser(UserResponseInterface $response)
    {
        dump($response->getAccessToken());
        dump($response->getExpiresIn());

        dd($response);
        $data = $response->getData();

        $user = new BnetOauthUser();
        $user->setBnetId($data['id']);
        $user->setBnetSub($data['sub']);
        $user->setBnetBattletag($data['battletag']);
        $user->setBnetAccessToken($response->getAccessToken());
        $user->setBnetAccessExpiresIn($response->getExpiresIn());

    }

    /**
     * @param UserResponseInterface $response
     *
     */
    public function loadUserByOAuthUserResponse(UserResponseInterface $response)
    {

        if( null === $bnetOauthUser = $this->manager->getRepository("App:BnetOauthUser")->findOneBy(['bnet_id' => $response->getUsername()])){
            $bnetOauthUser = $this->generateBnetOauthUser($response);

        }

        dd($response);
    }

}