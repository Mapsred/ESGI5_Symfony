<?php

namespace App\Controller;

use App\Form\RealmPlayerType;
use App\Utils\BattleNetSDK;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/dashboard")
 */
class DashboardController extends AbstractController
{
    /**
     * @Route("/", name="dashboard_index")
     * @param Request $request
     * @param BattleNetSDK $battleNetSDK
     * @return Response
     */
    public function index(Request $request, BattleNetSDK $battleNetSDK)
    {
        $form = $this->createForm(RealmPlayerType::class, null, [
            'realms' => $battleNetSDK->getRealms()
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            return $this->redirectToRoute('dashboard_stats', [
                    'user' => implode('-', [$data['realm'], $data['character_name']])]
            );
        }

        return $this->render('dashboard/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/stats", name="dashboard_stats")
     * @param Request $request
     * @param BattleNetSDK $battleNetSDK
     * @return Response
     */
    public function stats(Request $request, BattleNetSDK $battleNetSDK)
    {
        if (!$request->query->has('user')) {
            return $this->redirectToRoute('dashboard_index');
        }

        list($realm, $player) = explode('-', $request->query->get('user'));

        return $this->render('dashboard/stats.html.twig', [
            'realm' => $battleNetSDK->getRealm($realm),
            'player' => $player
        ]);
    }
}
