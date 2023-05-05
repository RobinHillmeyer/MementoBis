<?php

namespace App\Controller;

use App\Entity\User;

//use App\Form\ResaMidiType;
use App\Repository\CategoriesRepository;

//use App\Repository\ImagesPlatsSaleRepository;
//use App\Repository\ImagesPlatsSucreRepository;
use App\Repository\ImageRepository;

//use App\Repository\PlatsSaleRepository;
//use App\Repository\PlatsSucreRepository;
use App\Repository\TexteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function midi(
//        PlatsSaleRepository        $platsSaleRepository,
//                         PlatsSucreRepository       $platsSucreRepository,
//                         ImagesPlatsSaleRepository  $imagesPlatsSaleRepository,
//                         ImagesPlatsSucreRepository $imagesPlatsSucreRepository
    ): Response
    {
//        $platsSales = $platsSaleRepository->findLesPlatsSales();
//        $imagesPlatsSales = $imagesPlatsSaleRepository->findBy(array('PlatsSale' => $platsSales));
//        $platsSucres = $platsSucreRepository->findLesPlatsSucres();
//        $imagesPlatsSucres = $imagesPlatsSucreRepository->findBy(array('PlatsSucre' => $platsSucres));

        $quantite = 0;
        $total = 0;
        $totalGeneral = 0;
        $duree = 0;
        $totalDuree = 0;
        $panierSession = 0;

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        return $this->render('reservation/reservationMidi.html.twig', [
//            'platsSales' => $platsSales,
//            'platsSucres' => $platsSucres,
//            'imagesPlatsSales' => $imagesPlatsSales,
//            'imagesPlatsSucres' => $imagesPlatsSucres,
            'quantite' => $quantite,
            'total' => $total,
            'totalGeneral' => $totalGeneral,
            'paniersession' => $panierSession,
            'duree' => $duree,
            'totalDuree' => $totalDuree,
        ]);
    }

    #[Route('/validationMidi', name: 'validationMidi')]
    public function ValidationMidi(EntityManagerInterface $entityManager, Request $request): Response
    {
        $user = new User();
        $resaUserForm = $this->createForm(ResaMidiType::class, $user);
        $resaUserForm->handleRequest($request);

        if ($resaUserForm->isSubmitted() && $resaUserForm->isValid()) {

            $entityManager->persist($user);
            $entityManager->flush();

        }

        return $this->render('reservation/reservationValidationMidi.html.twig', [
            'resaUserForm' => $resaUserForm->createView(),
            'user' => $user
        ]);
    }

    #[Route('/soir', name: 'soir')]
    public function soir(): Response
    {
        return $this->render('reservation/reservationSoir.html.twig', [

        ]);
    }
}