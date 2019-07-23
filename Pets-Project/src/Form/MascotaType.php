<?php

namespace App\Form;

use App\Entity\Mascota;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Vich\UploaderBundle\Form\Type\VichImageType;


class MascotaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('Type', ChoiceType::class, [
                    'choices' => [
                        'Perro' => 'Perro',
                        'Gato' => 'Gato',
                    ],
                    'placeholder' => 'Seleciona el tipo de tú mascota...',    
                ])
            ->add('age')
            ->add('raza', ChoiceType::class, [
                'choices' => [
                    'Pequeña' => 'Pequeña',
                    'Mediana' => 'Mediana',
                    'Grande' => 'Grande',
                ],
       
                'placeholder' => 'Seleciona la raza de tú mascota...',    
            ])

            
            ->add('sexo', ChoiceType::class, [
                'choices' => [
                    'Macho' => 'Macho',
                    'Hembra' => 'Hembra',
                ],
       
                'placeholder' => 'Seleciona el sexo de tú mascota...',    
            ])
            
            ->add('imageFile', VichImageType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Mascota::class,
        ]);
    }
}
