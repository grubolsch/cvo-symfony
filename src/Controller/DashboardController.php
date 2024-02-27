<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\GameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(GameRepository $gameRepository): Response
    {
        $games = $gameRepository->findAll();

        return $this->render('dashboard/index.html.twig', [
            'games' => $games
        ]);
    }

    #[Route('/api/score/{user}', name: 'app_dashboard')]
    public function score(User $user, GameRepository $gameRepository): Response {
        $game = $gameRepository->findOneByApiKey($_GET['apiKey']);

        if($game->getHash($user) !== $_GET['hash']) {
            die('Jij vuile hacker');
        }
        dd($game);
    }
}
