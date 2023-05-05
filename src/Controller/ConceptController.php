<?php

namespace App\Controller;

use App\Repository\CategoriesRepository;
use App\Repository\ImageRepository;
use App\Repository\PlatRepository;
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
                                  PlatRepository $platRepository,
                                  CategoriesRepository $categoriesRepository,
                                  ImageRepository $imageRepository,
    ): Response
    {
        $categories = $categoriesRepository ->findOneBy(array('nom' => 'Concept du Midi'));
        $textes = $texteRepository ->findBy(array('categories' => $categories));
        $plats = $platRepository ->findAll();
        $images = $imageRepository ->findBy(array('texte' => $textes));
        $imagesplats = $imageRepository ->findBy(array('plat' => $plats));

        return $this->render('concept/conceptMidi.html.twig', [
            'categories' => $categories,
            'plats' => $plats,
            'textes' => $textes,
            'images' => $images,
            'imagesplats' => $imagesplats,
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
