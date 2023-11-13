<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() and $form->isValid()) {
            $contact->setCreatedAt(new \DateTimeImmutable());
            $entityManager->persist($contact);
            $entityManager->flush();

            $contact = new Contact();
            $form = $this->createForm(ContactType::class, $contact);

            $session = $request->getSession();
            $session->getFlashBag()->add("message", 'Message envoyé avec succès');
            $session->set('status', 'success');
        }
        elseif ($form->isSubmitted() and ! $form->isValid()) {
            $session = $request->getSession();
            $session->getFlashBag()->add("message", 'Merci de corriger les erreurs');
            $session->set('status', 'success');
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
