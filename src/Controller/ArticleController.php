<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Comment;
use App\Entity\User;
use App\Form\CommentType;
use App\Model\TimeInterface;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use DateTimeZone;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/article')]

class ArticleController extends AbstractController
{
    #[Route('/', name: 'app_article_index', methods: ['GET'])]
    public function index(
        ArticleRepository $articleRepository,
        PaginatorInterface $paginator,
        Request $request,
        Category $category,
    ):Response
    {
        $datas = $articleRepository->findBy([],['createdAt' => 'desc']);

        $articles = $paginator->paginate(
            $datas,
            $request->query->getInt('page', 1),
            12
        );

        return $this->render('article/index.html.twig', [
            'articles' => $articles,
            'category' => $category
        ]);
    }

    /**
     * @throws Exception
     */
    #[Route('/{slug}', name: 'app_article_show', methods: ['GET', 'POST'])]
    public function show($slug,
                         ArticleRepository $articleRepository,
                         CategoryRepository $categoryRepository,
                         Request $request,
                         EntityManagerInterface $entityManager
    ): Response
    {

        $article = $articleRepository->findOneBy([
            'slug' => $slug
        ]);
        $categories = $categoryRepository->findAll();

        if(!$article) {
            $this->addFlash('warning', 'L\'article demandé n\'est plus displonible');
            return $this->redirectToRoute('app_article_index');
        }
        $user = $this->getUser();
        $comment = new Comment();

        $commentForm = $this->createForm(CommentType::class, $comment);
        $commentForm->handleRequest($request);

        if($commentForm->isSubmitted() && $commentForm->isValid()) {
            $comment->setArticle($article);
            $comment->setUser($user);
            $comment->setCreatedAt(new \DateTime('now', new DateTimeZone('Europe/Paris')));

            $entityManager->persist($comment);
            $entityManager->flush();

            $this->addFlash('success', "Votre commentaire a bien été publié.");
            return $this->redirectToRoute('app_article_show', [
                'slug' => $slug
            ]);
        }

        return $this->render('article/show.html.twig', [
            'article' => $article,
            'categories' => $categories,
            'commentForm' => $commentForm->createView()
        ]);
    }
}
