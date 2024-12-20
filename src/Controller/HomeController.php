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
        // Récupérer les 2 derniers articles, triés par date de création décroissante
        $news = $newsRepository->findBy(
            [],
            ['createdAt' => 'DESC'],  // Trier par la date de création (ordre décroissant)
            3                        // Limiter à 2 résultats
        );

        return $this->render('home/index.html.twig', [
            'news' => $news,  // Passez les articles récupérés à la vue
        ]);
    }
}
