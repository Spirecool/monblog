<?php

namespace App\Controller;

use App\Repository\NewsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BlogController extends AbstractController
{
    #[Route('/blog', name: 'app_blog')]
    public function index(NewsRepository $newsRepository): Response
    {
            return $this->render('blog/index.html.twig', [
            'news'=> $newsRepository->findAll(), // on récupère avec la méthode findAll() toutes les news
        ]);
    }
}
