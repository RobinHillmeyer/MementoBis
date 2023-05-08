<?php

namespace App\Controller;

use App\Repository\CategoriesRepository;
use App\Repository\ImageRepository;
use App\Repository\TexteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MentionslegalesController extends AbstractController
{
    #[Route('/mentionslegales', name: 'mentionslegales')]
    public function mentionslegales(TexteRepository $texteRepository,
                                    CategoriesRepository $categoriesRepository,
                                    ImageRepository $imageRepository
    ): Response
    {
        $categories = $categoriesRepository ->findOneBy(array('nom' => 'Mentions Légales'));
        $textes = $texteRepository ->findBy(array('categories' => $categories));
        $images = $imageRepository ->findBy(array('texte' => $textes));

        return $this->render('mentionslegales/mentionslegales.html.twig', [
            'categories' => $categories,
            'textes' => $textes,
            'images' => $images
        ]);
    }
}
