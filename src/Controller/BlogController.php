<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    #[Route('/', name: 'app_blog')]
    public function index(ArticleRepository $articleRepository): Response
    {
        $articles = $articleRepository->findAll();

        return $this->render('blog/index.html.twig', [
            'articles' => $articles,
        ]);
    }

    #[Route('/article/{slug}', name: 'app_single_article')]
    public function single(ArticleRepository $articleRepository, string $slug): Response
    {
        $article = $articleRepository->findOneBy(['slug' => $slug]);

        return $this->render('blog/single.html.twig', [
            'article' => $article,
        ]);
    }
}
