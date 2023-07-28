<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LandingPageController extends AbstractController
{
    #[Route('/', name: 'app_landing_page')]
    public function index(): Response
    {
        $user = $this->getUser();
       
        $todos = $user ? $user->getTodos() : [];

        return $this->render('landingPage/landingPage.html.twig', [
            'user' => $user,
            'todos' => $todos
        ]);
    }
}
