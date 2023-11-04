<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(): Response
    {
        $form = $this->createFormBuilder()
            ->add("Email", EmailType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => "Votre email svp ...",
                    'class' => 'form-group'
                ]
            ])
            ->add("Subject", TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => "Votre objet svp ...",
                    'class' => 'form-group'
                ]
            ])
            ->add("Message", TextareaType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => "Votre message svp ...",
                    'class' => 'form-group'
                ]
            ])
            ->getForm()
        ;


        return $this->render('contact/index.html.twig', [
            'contact' => $form->createView()
        ]);
    }
}
