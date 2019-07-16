<?php

namespace App\Form;

use App\Entity\Servicio;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ServicioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
<<<<<<< HEAD
            ->add('Hora_Inicio')
            ->add('Hora_Fin')
            ->add('Servicio_Paquete')
=======
            ->add('Start_Time')
            ->add('time_end')
>>>>>>> 9290f0b2ebcdca55e13e8378efaa9b2fc905c190
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Servicio::class,
        ]);
    }
}
