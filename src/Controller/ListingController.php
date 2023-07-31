<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListingController extends AbstractController
{
    /**
     * @Route("/listing", name="blog_listing")
     */
    public function index(ArticleRepository $repository): Response
    {

        $articles = $repository->findAll();

        return $this->render('pages/listing.html.twig', [
            'controller_name' => 'ListingController',
            'articles' => $articles
        ]);
    }
}
