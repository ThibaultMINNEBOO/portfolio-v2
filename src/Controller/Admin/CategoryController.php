<?php

namespace App\Controller\Admin;

use App\Repository\TechnologyCategoryRepository;
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
}
