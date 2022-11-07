<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\User;
use App\Form\UserType;

class UserController extends AbstractController
{
    #[Route('/api/users', name: 'show_user')]
    public function index(ManagerRegistry $doctrine): JsonResponse
    {
        $users = $doctrine->getRepository(User::class)->findAll();

        $json = [];
        foreach ($users as $user)
        {
            $json []= $user->getData();
        }
        return $this->json($json);
    }

    #[Route('/api/users/create', name: 'create_user', methods: ['put'])]
    public function add(ManagerRegistry $doctrine, Request $req): JsonResponse
    {
        $user = new User();
        
        $form = $this->createForm(UserType::class, $user);
        $form->submit(json_decode($req->getContent(), true));

        if (!($form->isSubmitted() && $form->isValid()))
        {
            return $this->json(['error' => 1, 'error_desc' => 'upewnij się, że email jest poprawny']);
        }
       
        $doctrine->getManager()->persist($user);
        try
        { 
            $doctrine->getManager()->flush();
        }
        catch(\Throwable $e)
        {
            return $this->json(['error' => 1, 'error_desc' => 'najprawdopodobniej użytkwonik z tym emailem istnieje']);
        }

        return $this->json(['error' => 0]);    
    }

    // private 
}
