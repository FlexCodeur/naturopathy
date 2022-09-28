<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/category')]
class CategoryController extends AbstractController
{
//    #[Route('/', name: 'app_category_index', methods: ['GET'])]
//    public function index(EntityManagerInterface $entityManager): Response
//    {
//        $categories = $entityManager
//            ->getRepository(Category::class)
//            ->findAll();
//
//        return $this->render('category/index.html.twig', [
//            'categories' => $categories,
//        ]);
//    }


    #[Route('/{slug}', name: 'app_category_show', methods: ['GET'])]
    public function show(
        Category $category,
        CategoryRepository $categoryRepository,
        ArticleRepository $articleRepository,
        Request $request,
        PaginatorInterface $paginator,
    ): Response
    {
        $datas = $articleRepository->findBy([],['createdAt' => 'desc']);

        $articles = $paginator->paginate(
            $datas,
            $request->query->getInt('page', 1),
            12
        );
        return $this->render('category/show.html.twig', [
            'category' => $category,
            'categories' => $categoryRepository->findAll(),
            'articles' => $articles
        ]);
    }
}
