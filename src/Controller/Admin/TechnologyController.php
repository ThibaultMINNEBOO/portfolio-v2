<?php

namespace App\Controller\Admin;

use App\Entity\Technology;
use App\Form\TechnologyType;
use App\Repository\TechnologyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TechnologyController extends AbstractController
{
    #[Route('/admin/technology', name: 'app_admin_technology')]
    public function index(TechnologyRepository $technologyRepository, Request $request): Response
    {
        $search = $request->query->get('search', '');
        $technologies = $technologyRepository->search($search);

        return $this->render('admin/technology/index.html.twig', [
            'technologies' => $technologies,
            'searchedValue' => $search,
        ]);
    }

    #[Route('/admin/technology/new', name: 'app_technology_create')]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $technology = new Technology();

        $form = $this->createForm(TechnologyType::class, $technology);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($technology);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_technology');
        }

        return $this->render('admin/technology/create.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/admin/technology/{id}/edit', name: 'app_technology_edit')]
    public function edit(Request $request, EntityManagerInterface $entityManager, Technology $technology)
    {
        $form = $this->createForm(TechnologyType::class, $technology);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_technology');
        }

        return $this->render('admin/technology/edit.html.twig', [
            'form' => $form,
            'technology' => $technology,
        ]);
    }

    #[Route('/admin/technology/{id}/delete', name: 'app_technology_delete')]
    public function delete(Technology $technology, EntityManagerInterface $entityManager)
    {
        $entityManager->remove($technology);
        $entityManager->flush();

        return $this->redirectToRoute('app_admin_technology');
    }
}
