<?php

namespace App\Controller;

use App\Form\RealmPlayerType;
use App\Utils\BattleNetHelper;
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
     * @return Response
     */
    public function index(Request $request)
    {
        $form = $this->createForm(RealmPlayerType::class);

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
     * @param BattleNetHelper $battleNetHelper
     * @return Response
     */
    public function stats(Request $request, BattleNetHelper $battleNetHelper)
    {
        if (!$request->query->has('user')) {
            return $this->redirectToRoute('dashboard_index');
        }

        list($realm, $player) = explode('-', $request->query->get('user'));

        if (null === $profile = $battleNetHelper->findCharacter($player, $realm)) {
            $this->addFlash('error', sprintf('The player %s for realm %s does not exists', $player, $realm));

            return $this->redirectToRoute('dashboard_index');
        }

        if (null === $items = $battleNetHelper->findCharacterItems($player,$realm)){
            $this->addFlash('error', sprintf('The player %s for realm %s does not exists', $player, $realm));

            return $this->redirectToRoute('dashboard_index');
        }


        return $this->render('dashboard/stats.html.twig', [
            'realm' => $battleNetHelper->getBattleNetSDK()->getRealm($realm),
            'player' => $player,
            'profile' => $profile,
            'items' => $items
        ]);
    }
}
