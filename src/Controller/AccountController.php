<?php

namespace App\Controller;

use App\Repository\AdressRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/account")
 */
class AccountController extends AbstractController
{

    /**
     * @Route("/", name="account", methods={"GET"})
     */
    public function index(AdressRepository $adressRepository): Response
    {
        return $this->render('account/index.html.twig', [
            'adresses' => $adressRepository->findAll(),
        ]);
    }
}
