<?php

namespace App\Controller;

use App\Repository\CategoriesRepository;
use App\Repository\ImageRepository;
use App\Repository\TexteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CuisineController extends AbstractController
{
    #[Route('/cuisine', name: 'cuisine')]
    public function cuisine(TexteRepository $texteRepository,
                            CategoriesRepository $categoriesRepository,
                            ImageRepository $imageRepository
    ): Response
    {
        $categories = $categoriesRepository ->findOneBy(array('nom' => 'Cuisine'));
        $textes = $texteRepository ->findBy(array('categories' => $categories));
        $images = $imageRepository ->findBy(array('texte' => $textes));

        return $this->render('cuisine/cuisine.html.twig', [
            'categories' => $categories,
            'textes' => $textes,
            'images' => $images
        ]);
    }
}
