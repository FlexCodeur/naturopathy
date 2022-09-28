<?php
namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class LegalNoticeController extends AbstractController
{
    #[Route ("/pages/mentions-legales", name:"legal_notice")]
    public function legalNotice(CategoryRepository $categoryRepository)
    {
        return $this->render('pages/legalNotice.html.twig', [
            'categories' => $categoryRepository->findAll()
        ]);

    }
}
