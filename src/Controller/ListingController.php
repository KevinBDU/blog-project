<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

class ListingController extends AbstractController
{
    /**
     * @Route("/listing", name="blog_listing")
     */
    public function index(Request $request, ArticleRepository $repository, PaginatorInterface $paginator): Response
    {

        $articles = $repository->findAll();

        $articles = $paginator->paginate(
            $articles,
            $request->query->getInt('page', 2),
            2
        );

        return $this->render('pages/listing.html.twig', [
            'controller_name' => 'ListingController',
            'articles' => $articles
        ]);
    }
}
