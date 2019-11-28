<?php

namespace App\Form;

use App\Entity\Batch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BatchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('dateAcquired')
            ->add('costPerBird')
            ->add('numberOfMales')
            ->add('numberOfFemales')
            ->add('supplier')
            ->add('type')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Batch::class,
        ]);
    }
}
