<?php

namespace App\Controller;

use App\Entity\Smurf;
use App\Repository\SmurfRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function index(EntityManagerInterface $em): Response
    {
        $smurf = new Smurf();
        $smurf->setName('Grote smurf');
        $smurf->setGender(1);

        $em->persist($smurf);
        $em->flush();




        $age= 20;
        return $this->render('homepage/index.html.twig', [
            'controller_name' => 'HomepageController',
            'name' => 'Koen',
            'ingelogd' => false,
            'isAdult' => $age >= 18,
            'hobbies' => [

            ]
        ]);
    }

    #[Route('/ping-pong', name: 'app_ping')]
    public function ping(): Response
    {
        return $this->json(['message' => 'ok']);
    }

    #[Route('/smurf-old/{smurf}', name: 'app_smurf_old')]
    public function smurf(string $smurf, SmurfRepository $smurfRepository): Response
    {
        $smurf = $smurfRepository->findOneBy(['id' => $smurf]);
        return $this->json([
            'name' => $smurf->getName(),
            'gender' => $smurf->isGender() ? 'Man' : 'Vrouw'
        ]);
    }
}
