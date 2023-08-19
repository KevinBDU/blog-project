<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Repository\TagRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

class ListingController extends AbstractController
{
    /**
     * @Route("/", name="blog_listing")
     */
    public function index(Request $request, ArticleRepository $repository, PaginatorInterface $paginator, TagRepository $tagRepository): Response
    {
        $userSearch = $request->query->get('userSearch');

        if (isset($userSearch)) {
            $articles = $repository->findBySearch($userSearch);
        } else {
            $articles = $repository->findAll();
        }

        $tags = $tagRepository->findAll();
        $posts = $articles;

        $articles = $paginator->paginate(
            $articles,
            $request->query->getInt('page', 1),
            5
        );

        return $this->render('pages/listing.html.twig', [
            'controller_name' => 'ListingController',
            'posts' => $posts,
            'articles' => $articles,
            "tags" => $tags,
            "userSearch" => $userSearch
        ]);
    }
}