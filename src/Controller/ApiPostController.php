<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApiPostController extends AbstractController
{
    /**
     * @Route("/api/product", name="api_product", methods={"GET"})
     */
    public function showProduct(ProductRepository $productRepository)
    {
        return $this->json($productRepository->findAll(), 200, [], ['groups' => 'linkApiProducts']);
    }

    /**
     * @Route("/api/profile", name="api_profile", methods={"GET"})
     */
    public function showProfile(UserRepository $userRepository)
    {
        return $this->json($userRepository->findAll(), 200, [], ['groups' => 'linkApiProfile']);
    }
}
