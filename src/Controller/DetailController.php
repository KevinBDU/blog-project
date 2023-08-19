<?php

namespace App\Controller;

use App\Entity\Comment;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use App\Form\CommentType;
use App\Repository\ArticleRepository;

class DetailController extends AbstractController
{
    /**
     * @Route("/detail/{slug}", name="blog_detail")
     */
    public function index(Request $request, ArticleRepository $repository, $slug): Response
    {
        $posts = $repository->findAll();
        $article = $repository->findOneBySlug($slug);
        $post = $article;

        if (!$article) {
            return $this->redirectToRoute('blog_listing');
        }

        // creation du commentaire
        $comment = new Comment;

        // creation du formulaire
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        // traitement du formulaire
        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setArticle($article);

            // on recupere le contenu du champ parentid
            $parentid = $form->get("parentid")->getData();

            // on va chercher le commentaire correspondant
            $em = $this->getDoctrine()->getManager();
            if (isset($parentid)) {
                $parent = $em->getRepository(Comment::class)->findOneBy(["id" => $parentid]);
                // on definit le parent
                $comment->setParent($parent);
            }

            $em->persist($comment);
            $em->flush();

            $this->addFlash('form_success', 'Votre message a été envoyé et est en attente de modération.');
            return $this->redirectToRoute('blog_detail', [
                'slug' =>
                $article->getSlug()
            ]);
        }

        return $this->render('pages/detail.html.twig', [
            'controller_name' => 'DetailController',
            'article' => $article,
            'tags' => $article->getTags(),
            'posts' => $posts,
            'post' => $post,
            'form' => $form->createView()
        ]);
    }
}