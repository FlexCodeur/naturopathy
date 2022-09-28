<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Repository\CategoryRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function contact(
        CategoryRepository $categoryRepository,
        Request $request,
        MailerInterface $mailer
    ): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(ContactType::class);
        $contact = $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

                $email = (new TemplatedEmail())
                    ->from($contact->get('email')->getData())
                    ->to('mehdi.rezgane@campusdulac.com')
                    ->replyTo($contact->get('email')->getData())
                    ->subject($contact->get('object')->getData())
                    ->htmlTemplate('emails/contact.html.twig')
                    ->context([
                        'firstName' => $contact->get('firstName')->getData(),
                        'lastName'  => $contact->get('lastName')->getData(),
                        'mail'      => $contact->get('email')->getData(),
                        'phone'     => $contact->get('phone')->getData(),
                        'message'   => $contact->get('message')->getData()
                    ]);

            $mailer->send($email);
//            dd($email);
            $this->addFlash('success', 'Votre message a bien été envoyé');
            return $this->redirectToRoute('app_contact');
        }

        return $this->render('contact/index.html.twig', [
            'formContact' => $form->createView(),
            'categories' => $categoryRepository->findAll()
        ]);
    }
}
