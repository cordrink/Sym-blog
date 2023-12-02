<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Article Title',
                ],
                'row_attr' => [
                    'class' => 'form-group flex'
                ]
            ])
            ->add('content', TextareaType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Article Content ...',
                ],
                'row_attr' => [
                    'class' => 'form-group flex'
                ]
            ])
            ->add('imageFile', FileType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => '',
                ],
                'row_attr' => [
                    'class' => 'form-group flex'
                ]
            ])
            ->add('categories', EntityType::class, [
                'label' => false,
                'class' => Category::class,
                'choice_label' => 'name',
                'multiple' => true,
                'attr' => [
                    'class' => 'choice_categories',
                ],
                'row_attr' => [
                    'class' => 'form-group flex'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
