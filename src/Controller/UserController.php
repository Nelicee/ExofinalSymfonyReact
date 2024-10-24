<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('user/index.html.twig');
    }

    #[Route('/user/{id}', name: 'UserPossessions')]
    public function details($id): Response
    {
        return $this->render('user/details.html.twig',["id"=>$id],);
    }

}
