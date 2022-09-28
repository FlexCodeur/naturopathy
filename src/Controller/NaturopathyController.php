<?php
namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class NaturopathyController extends AbstractController
{
#[Route ("/pages/la-naturopathie", name:"naturopathy")]
    public function naturopathy(CategoryRepository $categoryRepository)
    {
    return $this->render('pages/naturopathy.html.twig', [
        'categories' => $categoryRepository->findAll()
    ]);
    }
}