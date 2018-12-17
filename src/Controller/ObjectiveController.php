<?php

namespace App\Controller;

use App\Form\ObjectiveType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/objectives")
 */
class ObjectiveController extends AbstractController
{
    /**
     * @Route("/", name="objectives_index")
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('objective/index.html.twig', [
            'objectives' => [],
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
        // TODO : Remplace name
        $form = $this->createForm(ObjectiveType::class, null, ['username' => 'Zeng', 'realm' => 'Hyjal']);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            // TODO : Set $objectif['bnet_id']
            $objective = $form->getData();
            dd($objective);
            // TODO : Save
        }

        return $this->render('objective/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
