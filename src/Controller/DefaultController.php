<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\BattlePet;

/**
 * Class DefaultController
 * @package App\Controller
 */
class DefaultController extends AbstractController
{
    /**
     * @Route("/{id<\d+>?1}", name="index")
     * @param $id
     * @return Response
     */
    public function index($id)
    {
        $battlePet = $this->getDoctrine()->getRepository(BattlePet::class)->find($id);

        if (!$battlePet) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'BattlePet' => $battlePet
        ]);
    }
}
