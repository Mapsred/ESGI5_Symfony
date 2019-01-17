<?php

namespace App\Controller;

use App\Configuration\CharacterRequired;
use App\Entity\Objective;
use App\Form\ObjectiveType;
use App\Repository\ObjectiveRepository;
use App\Utils\CharacterHelper;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/objectives")
 * @Security("is_granted('ROLE_USER')")
 */
class ObjectiveController extends AbstractController
{
    /** @var ObjectiveRepository $objectiveRepository */
    private $objectiveRepository;

    /** @var CharacterHelper $characterHelper */
    private $characterHelper;

    /**
     * @param ObjectiveRepository $objectiveRepository
     * @param CharacterHelper $characterHelper
     */
    public function __construct(ObjectiveRepository $objectiveRepository, CharacterHelper $characterHelper)
    {
        $this->objectiveRepository = $objectiveRepository;
        $this->characterHelper = $characterHelper;
    }

    /**
     * @Route("/", name="objectives_index")
     * @CharacterRequired()
     *
     * @return Response
     */
    public function index(): Response
    {
        $objectives = $this->objectiveRepository->findAllByBnetId($this->getUser()->getBnetId());

        return $this->render('objective/index.html.twig', [
            'objectives' => $objectives,
        ]);
    }

    /**
     * @Route("/create", name="objectives_create")
     * @CharacterRequired()
     *
     * @param Request $request
     * @return Response
     */
    public function create(Request $request): Response
    {
        list('realm' => $realm, 'name' => $username) = $request->attributes->get('_character');

        $form = $this->createForm(ObjectiveType::class, null, ['username' => $username, 'realm' => $realm]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Objective $objective */
            $objective = $form->getData();
            $objective
                ->setBnetId($this->getUser()->getBnetId())
                ->setBnetOauthUser($this->getUser())
                ->setUsername($username)
                ->setRealm($realm);

            $this->objectiveRepository->save($objective);

            return $this->redirectToRoute('objectives_index');
        }

        return $this->render('objective/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
