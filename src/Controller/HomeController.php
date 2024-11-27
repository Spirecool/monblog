<?php

namespace App\Controller;

use App\Repository\NewsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(NewsRepository $newsRepository): Response
    {
            return $this->render('home/index.html.twig', [
            'news'=> $newsRepository->findAll(), // on récupère avec la méthode findAll() toutes les news
        ]);
    }
}
