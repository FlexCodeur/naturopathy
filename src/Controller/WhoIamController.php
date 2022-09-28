<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class WhoIamController extends AbstractController
{
#[Route ("/pages/qui-suis-je", name:'who_iam')]
    public function whoIam (CategoryRepository $categoryRepository)
    {
       return $this->render('pages/whoIam.html.twig', [
           'categories' => $categoryRepository->findAll()
       ]);
    }
}