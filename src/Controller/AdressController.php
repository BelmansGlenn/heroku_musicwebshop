<?php

namespace App\Controller;

use App\Entity\Adress;
use App\Form\AdressType;
use App\Repository\AdressRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/adress")
 */
class AdressController extends AbstractController
{

    /**
     * @Route("/new", name="adress_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $adress = new Adress();
        $form = $this->createForm(AdressType::class, $adress);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            $adress->setUser($user);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($adress);
            $entityManager->flush();

            $this->addFlash('adress_message', 'Your address has been created.');
            return $this->redirectToRoute('account', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('adress/new.html.twig', [
            'adress' => $adress,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="adress_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Adress $adress): Response
    {
        $form = $this->createForm(AdressType::class, $adress);
        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('adress_message', 'Your address has been updated.');
            return $this->redirectToRoute('account', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('adress/edit.html.twig', [
            'adress' => $adress,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="adress_delete", methods={"POST"})
     */
    public function delete(Request $request, Adress $adress): Response
    {
        if ($this->isCsrfTokenValid('delete' . $adress->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($adress);
            $entityManager->flush();

            $this->addFlash('adress_message', 'Your address has been deleted.');
        }

        return $this->redirectToRoute('account', [], Response::HTTP_SEE_OTHER);
    }
}
