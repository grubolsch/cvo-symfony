<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JasonController extends AbstractController
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    #[Route('/jason', name: 'app_jason')]
    public function index(Connection $connection, ): Response
    {
        $q = $connection->prepare('select username, email from user where email = :email');
        $q = $q->executeQuery(['email' => 'test@test.be']);
        $data = $q->fetchAllAssociativeIndexed();

        $user = $this->userRepository->findBySpecial(['email' => 'test@test.be']);

        dd($user);

        return $this->json($user);
    }
}
