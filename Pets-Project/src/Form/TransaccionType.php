<?php

namespace App\Form;

use App\Entity\Transaccion;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TransaccionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('producto')
            ->add('monto')
            ->add('divisa')
            ->add('estado')
            ->add('create_at')
            ->add('transaccion')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Transaccion::class,
        ]);
    }
}
