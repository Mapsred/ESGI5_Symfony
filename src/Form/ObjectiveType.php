<?php

namespace App\Form;

use App\Entity\Objective;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ObjectiveType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class)
            ->add('ending_date', DateType::class)
            ->add('achievement_id', AchievementType::class, [
                'label' => 'Achievement',
                'username' => $options['username'],
                'realm' => $options['realm']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Objective::class,
        ]);

        $resolver->setRequired([
            'username',
            'realm',
        ]);
    }
}
