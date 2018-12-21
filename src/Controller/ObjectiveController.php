<?php

namespace App\Controller;

use App\Entity\Objective;
use App\Form\ObjectiveType;
use App\Repository\ObjectiveRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/objectives")
 */
class ObjectiveController extends AbstractController
{

    private $objectiveRepository;

    public function __construct(ObjectiveRepository $objectiveRepository)
    {
        $this->objectiveRepository = $objectiveRepository;
    }

    /**
     * @Route("/", name="objectives_index")
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
     *
     * @param Request $request
     * @return Response
     */
    public function create(Request $request): Response
    {
        $username = 'Zeng';
        $realm = 'Hyjal';

        $form = $this->createForm(ObjectiveType::class, null, ['username' => $username, 'realm' => $realm]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Objective $objective */
            $objective = $form->getData();
            $objective->setBnetId($this->getUser()->getBnetId());
            $objective->setUsername($username);
            $objective->setRealm($realm);

            $this->objectiveRepository->save($objective);

            return $this->redirectToRoute('objectives_index');
        }

        return $this->render('objective/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
