<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category/{slug}", name="app_category")
     */
    public function index(): Response
    {
        return $this->render('pages/category.html.twig', [
            'controller_name' => 'CategoryController',
        ]);
    }
}
