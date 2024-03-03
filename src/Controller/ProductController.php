<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'listProducts')]
    public function listProducts(): Response
    {
        return $this->render('product/index.html.twig', [
            'listProducts' => 'Liste des produits'
        ]);
    }

    #[Route('/product/{id}', name: 'viewProduct')]
    public function viewProduct($id): Response
    {
        return $this->render('product/index.html.twig', [
            'listProducts' => 'Affichage du produit ' . $id,
        ]);
    }
}