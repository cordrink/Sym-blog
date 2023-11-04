<?php

namespace App\Services;

use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\RequestStack;

class CategoriesServices {
    private CategoryRepository $repoCat;
    private RequestStack $requestStack;

    public function __construct(RequestStack $requestStack, CategoryRepository $repoCat)
    {
        $this->repoCat = $repoCat;
        $this->requestStack = $requestStack;
    }

    public function updateSession(): void
    {
        $session = $this->requestStack->getSession();
        $categories = $this->repoCat->findAll();
        $session->set("categories", $categories);
    }
}