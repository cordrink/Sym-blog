<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
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

    #[Route('/category/{slug}', name: 'app_article_by_category')]
    public function article_by_category(string $slug, CategoryRepository $categoryRepository): Response
    {
        $category = $categoryRepository->findOneBy(['slug' => $slug]);

        $articles = [];
        if ($category) {
            $articles = $category->getArticles()->getValues();
        }


        return $this->render('blog/article_by_category.html.twig', [
            'articles' => $articles,
            'category' => $category,
        ]);
    }
}
