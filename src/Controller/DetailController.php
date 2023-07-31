<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use App\Repository\ArticleRepository;

class DetailController extends AbstractController
{
    /**
     * @Route("/detail/{slug}", name="blog_detail")
     */
    public function index(ArticleRepository $repository, $slug): Response
    {
        $articles = $repository->findAll();
        $article = $repository->findOneBySlug($slug);

        if (!$article) {
            return $this->redirectToRoute('blog_listing');
        }

        return $this->render('pages/detail.html.twig', [
            'controller_name' => 'DetailController',
            'articles' => $articles,
            'article' => $article
        ]);
    }
}
