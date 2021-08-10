<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApiPostController extends AbstractController
{
    /**
     * @Route("/api/product", name="api_post_index", methods={"GET"})
     */
    public function index(ProductRepository $productRepository, SerializerInterface $serializer)
    {
        $posts = $productRepository->findAll();

        // $postsNormalises = $normalizer->normalize($posts, null, ['groups' => 'jecrisCqueJveux']);

        // $json = json_encode($postsNormalises);

        $json = $serializer->serialize($posts, 'json', ['groups' => 'linkApiProducts']);

        // $response = new Response($json, 200, [
        //     "Content-Type" => "application/json"
        // ]);

        $response = new JsonResponse($json, 200, [], true);
        return $response;
    }
}
