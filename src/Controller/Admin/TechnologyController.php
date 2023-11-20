<?php

namespace App\Controller\Admin;

use App\Repository\TechnologyRepository;
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
}
