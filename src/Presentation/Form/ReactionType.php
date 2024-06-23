<?php

namespace App\Presentation\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReactionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('resumeId', HiddenType::class)
            ->add('companyId', HiddenType::class)
            ->add('reactionType', ChoiceType::class, [
                'choices' => [
                    'Positive' => 'positive',
                    'Negative' => 'negative'
                ]
            ])
            ->add('sentDate', DateType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([]);
    }
}