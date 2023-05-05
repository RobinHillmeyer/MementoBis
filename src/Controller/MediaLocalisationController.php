<?php

namespace App\Controller;

use App\Repository\CategoriesRepository;
use App\Repository\ImageRepository;
use App\Repository\TexteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MediaLocalisationController extends AbstractController
{
    #[Route('/media/localisation', name: 'media_localisation')]
    public function media(TexteRepository $texteRepository,
                          CategoriesRepository $categoriesRepository,
                          ImageRepository $imageRepository
    ): Response
    {
        $categories = $categoriesRepository ->findOneBy(array('nom' => 'Média Localisation Contact'));
        $textes = $texteRepository ->findBy(array('categories' => $categories));
        $images = $imageRepository ->findBy(array('texte' => $textes));

        return $this->render('media_localisation/mediaLocalisation.html.twig', [
            'categories' => $categories,
            'textes' => $textes,
            'images' => $images
        ]);
    }

}
