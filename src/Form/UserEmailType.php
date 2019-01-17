<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;

class UserEmailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('mail_enabled', CheckboxType::class, [
                'label' => 'Allow emails',
                'help' => 'Allow WowCollection to send you email to remind you of your objective and when it is completed',
                'required' => false
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email Address',
            ])
        ;
    }
}
