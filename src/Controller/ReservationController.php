<?php

namespace App\Controller;

use App\Repository\CategoriesRepository;
use App\Repository\ImageRepository;
use App\Repository\PlatRepository;
use App\Repository\TexteRepository;
use App\Service\PanierService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/', name: 'reservation_')]
class ReservationController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function home(TexteRepository      $texteRepository,
                         CategoriesRepository $categoriesRepository,
                         ImageRepository      $imageRepository
    ): Response
    {
        $categories = $categoriesRepository->findOneBy(array('nom' => 'Réservation'));
        $textes = $texteRepository->findBy(array('categories' => $categories));
        $images = $imageRepository->findBy(array('texte' => $textes));

        return $this->render('reservation/reservation.html.twig', [
            'categories' => $categories,
            'textes' => $textes,
            'images' => $images
        ]);
    }

    #[Route('/midi', name: 'midi')]
    public function midi(PlatRepository  $platRepository,
                         ImageRepository $imageRepository,
                         PanierService   $panierService
    ): Response
    {

        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        $plats = $platRepository->findAll();
        $imagesplats = $imageRepository->findBy(array('plat' => $plats));

        return $this->render('reservation/reservationMidi.html.twig', [

            'plats' => $plats,
            'imagesplats' => $imagesplats,
            'panier' => $panierService->getTotal(),
        ]);
    }

    #[Route('/midi/add/{id<\d+>}', name: 'add')]
    public function addToRoute(PanierService $panierService, int $id): Response
    {
        $panierService->addToCart($id);
        return $this->redirectToRoute('reservation_midi');
    }

    #[Route('/midi/remove/{id<\d+>}', name: 'remove')]
    public function RemoveToRoute(PanierService $panierService, int $id): Response
    {
        $panierService->removeToCart($id);
        return $this->redirectToRoute('reservation_midi');
    }

    #[Route('/midi/removeAll', name: 'removeAll')]
    public function removeAll(PanierService $panierService): Response
    {
        $panierService->removePanier();
        return $this->redirectToRoute('reservation_midi');
    }

    #[Route('/validationMidi', name: 'validationMidi')]
    public function ValidationMidi(PanierService   $panierService): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        return $this->render('reservation/reservationValidationMidi.html.twig', [
            'user' => $this->getUser(),
            'panier' => $panierService->getTotal(),
        ]);
    }

    #[Route('/soir', name: 'soir')]
    public function soir(): Response
    {
        return $this->render('reservation/reservationSoir.html.twig', [

        ]);
    }
}
