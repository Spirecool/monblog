<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
            return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
