<?php

namespace App\Controller;

use App\Utils\BattleNetSDK;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DefaultController
 * @package App\Controller
 */
class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(Request $request)
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    /**
     * @Route("/authorize", name="authorize")
     * @param BattleNetSDK $battleNetSDK
     * @return Response
     */
    public function authorize(BattleNetSDK $battleNetSDK)
    {
//        var_dump($battleNetSDK->getRealms());
        var_dump($battleNetSDK->getRealm('hyjal'));

        return new Response();
    }

}
