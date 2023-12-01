<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fullName', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Votre Nom ...',
                ],
                "row_attr" => [
                    "class" => "form-group flex",
                ],
            ])
            ->add('email', EmailType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Votre Email ...',
                ],
                "row_attr" => [
                    "class" => "form-group flex",
                ],
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('plainPassword', RepeatedType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'type' => PasswordType::class,
                'invalid_message' => 'Mot de passe incorrecte',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options' => [
                    'label' => false,
                    'attr' => [
                        'placeholder' => 'Votre mot de passe ...',
                    ],
                    "row_attr" => [
                        "class" => "form-group flex"
                    ],
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Entrez un mot de passe',
                        ]),
                        new Length([
                            'min' => 3,
                            'minMessage' => 'Votre mot de passe doit comporter au moins {{ limit }} caractères.',
                            // max length allowed by Symfony for security reasons
                            'max' => 4096,
                        ]),
                    ],
                ],
                'second_options' => [
                    'label' => false,
                    'attr' => [
                        'placeholder' => 'Confirmez votre mot de passe ...',
                    ],
                    "row_attr" => [
                        "class" => "form-group flex",
                    ],
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Entrez un mot de passe',
                        ]),
                        new Length([
                            'min' => 3,
                            'minMessage' => 'Votre mot de passe doit comporter au moins {{ limit }} caractères.',
                            // max length allowed by Symfony for security reasons
                            'max' => 4096,
                        ]),
                    ],
                ],
//                'attr' => ['autocomplete' => 'new-password'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
