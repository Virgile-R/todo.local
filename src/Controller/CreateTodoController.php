<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Todos;
use App\Form\CreateTodoType;

class CreateTodoController extends AbstractController
{
    #[Route('/create/todo', name: 'app_create_todo')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $todo = new Todos();
        $form = $this->createForm(CreateTodoType::class, $todo);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $todo->setCreatorId($user);
            $entityManager->persist($todo);
            $entityManager->flush();
            return $this->redirectToRoute('app_landing_page', [
                'todoName' => $todo->getName()
            ]);
        };

        return $this->render('create_todo/index.html.twig', [
            'createTodoForm' => $form->createView(),
        ]);
    }
    #[Route('/edit/todo/{id}', name: 'app_create_todo')]
    public function edit(Request $request, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
    }
}
