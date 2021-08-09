<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/CGU")
 */

class CGUController extends AbstractController
{
    /**
     * @Route("/general_condition_of_use", name="gcu")
     */
    public function index(): Response
    {
        return $this->render('cgu/index.html.twig', [
            'controller_name' => 'CGUController',
        ]);
    }
}
