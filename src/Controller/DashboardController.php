<?php

namespace App\Controller;

use App\Form\RealmPlayerType;
use App\Utils\BattleNetHelper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/dashboard")
 */
class DashboardController extends AbstractController
{

    /**
     * @var SessionInterface $session
     */
    private $session;

    /**
     * @param SessionInterface $session
     */
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * @Route("/", name="dashboard_index")
     * @param Request $request
     * @param BattleNetHelper $battleNetHelper
     * @return Response
     */
    public function index(Request $request, BattleNetHelper $battleNetHelper): Response
    {
        $form = $this->createForm(RealmPlayerType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            if (null === $profile = $battleNetHelper->findCharacter($data['character_name'], $data['realm'])) {
                $this->addFlash('error',
                    sprintf('The player %s for realm %s does not exists', $data['character_name'], $data['realm']));

                return $this->redirectToRoute('dashboard_index');
            }

            $this->session->set('character', [
                'realm' => $data['realm'],
                'name' => $data['character_name'],
            ]);

            if ($request->query->get('redirect')) {
                return $this->redirect($request->query->get('redirect'));
            }

            return $this->redirectToRoute('dashboard_stats');
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
    public function stats(Request $request, BattleNetHelper $battleNetHelper): Response
    {
        $character = $this->session->get('character');
        if (!$character) {
            return $this->redirectToRoute('dashboard_index', ['redirect' => $request->getRequestUri()]);
        }

        $player = $character['name'];
        $realm = $character['realm'];

        $profile = $battleNetHelper->findCharacter($player, $realm);

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