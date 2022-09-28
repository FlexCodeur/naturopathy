<?php
namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route ("/", name:"home")]
public function home(ArticleRepository $articleRepository, CategoryRepository
    $categoryRepository)
    {
        return $this->render('pages/home.html.twig', [
            'articles' => $articleRepository->findAll(),
            'categories' => $categoryRepository->findAll()
        ]);
    }
}
