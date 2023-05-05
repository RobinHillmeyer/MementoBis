<?php

namespace App\Controller;

use App\Repository\CategoriesRepository;
//use App\Repository\ImagesPlatsSaleRepository;
//use App\Repository\ImagesPlatsSucreRepository;
use App\Repository\ImageRepository;
//use App\Repository\PlatsSaleRepository;
//use App\Repository\PlatsSucreRepository;
use App\Repository\TexteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/concepts', name: 'concept_')]
class ConceptController extends AbstractController
{
    #[Route('', name: 'general')]
    public function concept(TexteRepository $texteRepository,
                            CategoriesRepository $categoriesRepository,
                            ImageRepository $imageRepository
    ): Response
    {
        $categories = $categoriesRepository ->findOneBy(array('nom' => 'Concept'));
        $textes = $texteRepository ->findBy(array('categories' => $categories));
        $images = $imageRepository ->findBy(array('texte' => $textes));

        return $this->render('concept/concept.html.twig', [
            'categories' => $categories,
            'textes' => $textes,
            'images' => $images
        ]);
    }

    #[Route('/midi', name: 'midi')]
    public function conceptDuMidi(TexteRepository $texteRepository,
//                                  PlatsSaleRepository $platsSaleRepository,
//                                  PlatsSucreRepository $platsSucreRepository,
                                  CategoriesRepository $categoriesRepository,
                                  ImageRepository $imageRepository,
//                                  ImagesPlatsSaleRepository $imagesPlatsSaleRepository,
//                                  ImagesPlatsSucreRepository $imagesPlatsSucreRepository
    ): Response
    {
        $categories = $categoriesRepository ->findOneBy(array('nom' => 'Concept du Midi'));

        $textes = $texteRepository ->findBy(array('categories' => $categories));
        $images = $imageRepository ->findBy(array('texte' => $textes));
//
//        $platsSales = $platsSaleRepository ->findLesPlatsSales();
//        $imagesPlatsSales = $imagesPlatsSaleRepository ->findBy(array('PlatsSale' => $platsSales));
//
//        $platsSucres = $platsSucreRepository ->findLesPlatsSucres();
//        $imagesPlatsSucres = $imagesPlatsSucreRepository ->findBy(array('PlatsSucre' => $platsSucres));



        return $this->render('concept/conceptMidi.html.twig', [
            'categories' => $categories,

            'textes' => $textes,
            'images' => $images,
//
//            'platsSales' => $platsSales,
//            'platsSucres' => $platsSucres,
//            'imagesPlatsSales' => $imagesPlatsSales,
//            'imagesPlatsSucres' => $imagesPlatsSucres,
        ]);
    }

    #[Route('/soir', name: 'soir')]
    public function conceptDuSoir(TexteRepository $texteRepository,
                                  CategoriesRepository $categoriesRepository,
                                  ImageRepository $imageRepository
    ): Response
    {
        $categories = $categoriesRepository ->findOneBy(array('nom' => 'Concept du Soir'));
        $textes = $texteRepository ->findBy(array('categories' => $categories));
        $images = $imageRepository ->findBy(array('texte' => $textes));

        return $this->render('concept/conceptSoir.html.twig', [
            'categories' => $categories,
            'textes' => $textes,
            'images' => $images
        ]);
    }

}
