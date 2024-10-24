<?php

namespace App\Controller\API;

use App\Entity\Possession;
use App\Entity\User;
use App\Repository\PossessionRepository;
use App\Repository\UserRepository;
use App\Service\UserService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Requirement\Requirement;





#[Route('/api/users')]
class UsersController extends AbstractController
{
    #[Route("/")]
    public function index(UserRepository $repository, UserService $userService): JsonResponse
    {
        
        $users = $repository->findAll();
        // $age = [];
        // foreach ($users as $user) {
        //     $age[$user->getId()] = $userService->AgeCalculation($user);
        // }
        $usersWithAge = [];

        foreach ($users as $user) {
            $userData = [
                'user' => $user,
                'age' => $userService->AgeCalculation($user)
            ];
            $usersWithAge[] = $userData;
        }

        
        return $this->json($users, 200, [], [
            'groups' => ['users.index'],
        ]);
    }

    #[Route("/{id}", requirements: ['id' => Requirement::DIGITS], methods: ['GET'])]
    public function details(UserRepository $repository, int $id, PossessionRepository $possessions): JsonResponse
    {
        $user = $repository->find($id);
        $userPossessions = $possessions->findBy(['user' => $user]);
        $data = [
            'user' => $user,
            'possessions' => $userPossessions
        ];
        return $this->json($data, 200, [], [
            'groups' => ['users.index', 'user.details'],
        ]);
    }
    #[Route("/{id}", requirements: ['id' => Requirement::DIGITS], methods: ['DELETE'])]
    public function delete(User $user, EntityManagerInterface $em): JsonResponse
    {
        $em->remove($user);
        $em->flush();

        // return new JsonResponse(['status' => 'User deleted'], Response::HTTP_NO_CONTENT);
        return $this->json($user, 200, [], [
            'groups' => ['users.index', 'user.details'],
        ]);
    }
}
