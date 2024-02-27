<?php

namespace App\Controller;

use App\Entity\Smurf;
use App\Form\SmurfType;
use App\Repository\SmurfRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/smurf')]
class SmurfController extends AbstractController
{
    #[Route('/', name: 'app_smurf_index', methods: ['GET'])]
    public function index(SmurfRepository $smurfRepository): Response
    {
        if(!$this->getUser()) {
            throw $this->redirectToRoute('app_login');
        }


        return $this->render('smurf/index.html.twig', [
            'smurves' => $smurfRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_smurf_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $smurf = new Smurf();
        $form = $this->createForm(SmurfType::class, $smurf);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($smurf);
            $entityManager->flush();

            return $this->redirectToRoute('app_smurf_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('smurf/new.html.twig', [
            'smurf' => $smurf,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_smurf_show', methods: ['GET'])]
    public function show(Smurf $smurf): Response
    {
        return $this->render('smurf/show.html.twig', [
            'smurf' => $smurf,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_smurf_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Smurf $smurf, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SmurfType::class, $smurf);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_smurf_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('smurf/edit.html.twig', [
            'smurf' => $smurf,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_smurf_delete', methods: ['POST'])]
    public function delete(Request $request, Smurf $smurf, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$smurf->getId(), $request->request->get('_token'))) {
            $entityManager->remove($smurf);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_smurf_index', [], Response::HTTP_SEE_OTHER);
    }
}
