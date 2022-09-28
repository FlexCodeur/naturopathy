<?php
namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PrivacyPolicyController extends AbstractController
{
    #[Route ("/pages/politique-de-confidentialité", name:"privacy_policy")]
    public function privacyPolicy(CategoryRepository $categoryRepository)
    {
        return $this->render('pages/PrivacyPolicy.html.twig', [
            'categories' => $categoryRepository->findAll()

        ]);
    }
}
