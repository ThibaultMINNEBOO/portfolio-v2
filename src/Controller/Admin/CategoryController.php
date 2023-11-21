<?php

namespace App\Controller\Admin;

use App\Entity\Technology;
use App\Entity\TechnologyCategory;
use App\Form\TechnologyCategoryType;
use App\Repository\TechnologyCategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    #[Route('/admin/category', name: 'app_admin_category')]
    public function index(TechnologyCategoryRepository $categoryRepository, Request $request): Response
    {
        $search = $request->query->get('search', '');
        $categories = $categoryRepository->search($search);

        return $this->render('admin/category/index.html.twig', [
            'categories' => $categories,
            'searchedValue' => $search,
        ]);
    }

    #[Route('/admin/category/{id}/edit', name: 'app_category_edit')]
    public function edit(TechnologyCategory $category, Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TechnologyCategoryType::class, $category);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_category');
        }

        return $this->render('admin/category/edit.html.twig', [
            'form' => $form,
            'category' => $category,
        ]);
    }

    #[Route('/admin/category/{id}/delete', name: 'app_category_delete')]
    public function delete(TechnologyCategory $category, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($category);
        $entityManager->flush();

        return $this->redirectToRoute('app_admin_category');
    }

    #[Route('/admin/category/new', name: 'app_category_create')]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $category = new TechnologyCategory();

        $form = $this->createForm(TechnologyCategoryType::class, $category);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($category);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_category');
        }

        return $this->render('admin/category/create.html.twig', [
            'form' => $form,
        ]);
    }
}
