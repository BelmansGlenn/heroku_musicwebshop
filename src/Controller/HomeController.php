<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    /**
     * @Route("/home", name="home")
     */
    public function index(ProductRepository $repoProduct): Response
    {
        $products = $repoProduct->findAll();
        $productsBestSeller = $repoProduct->findByIsBestSeller(1);
        $productsFeatured = $repoProduct->findByIsFeatured(1);
        $productsNewArrival = $repoProduct->findByIsNewArrival(1);
        $productsSpecialOffer = $repoProduct->findByIsSpecialOffer(1);
        return $this->render('home/index.html.twig', [
            'products' => $products,
            'productsBestSeller' => $productsBestSeller,
            'productsFeatured' => $productsFeatured,
            'productsNewArrival' => $productsNewArrival,
            'productsSpecialOffer' => $productsSpecialOffer
        ]);
    }

    /**
     * @Route("/product/{id}", name="product_details")
     */
    public function show(?Product $product): Response
    {

        if (!$product) {
            return $this->redirectToRoute("home");
        }

        return $this->render("home/show_product.html.twig", [
            'product' => $product
        ]);
    }
}
