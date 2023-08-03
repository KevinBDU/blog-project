<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use App\Repository\ArticleRepository;

class RecentPostController extends AbstractController
{
    /**
     * @Route("/recent-post", name="app_recent_post")
     */
    public function index(ArticleRepository $repository): Response
    {
        $articles = $repository->findAll();

        return $this->render('pages/recent.html.twig', [
            'controller_name' => 'RecentPostController',
            'articles' => $articles
        ]);
    }
}
