<?php

namespace App\Controller;

use App\Service\PanierService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
//    #[Route('/mon-panier', name: 'panier_index')]
//    public function index(PanierService $panierService): Response
//    {
////        dd($panierService->getTotal());
//        return $this->render('panier/index.html.twig', [
//            'panier' => $panierService->getTotal()
//        ]);
//    }
//
//    #[Route('/mon-panier/add/{id}', name: 'panier_add')]
//    public function addToRoute(PanierService $panierService, int $id): Response
//    {
//        $panierService->addToCart($id);
//        return $this->redirectToRoute('panier_index');
//    }
//
//    #[Route('/mon-panier/removeAll', name: 'panier_remove')]
//    public function removeAll(PanierService $panierService): Response
//    {
//        $panierService->removePanier();
//        return $this->redirectToRoute('panier_index');
//    }
}
