<?php

namespace App\Form;

use App\Entity\Paquete;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class Paquete1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Tipo_Masc', ChoiceType::class,[
                    'choices' => [
                        'Perro' => 'Perro',
                        'Gato' => 'Gato',
                    ],
                    'placeholder' => 'Seleciona el tipo de mascota que vas a alojar...', 
            ])
            ->add('Alimento', ChoiceType::class,[
                    'choices' => [
                        'Casa' => 'comida casera',
                        'Especial' => 'especial para animal',
                    ],
                    'placeholder' => 'Seleciona que alimento proporcionaras', 
            ])
            ->add('Aseo_Masc', ChoiceType::class,[
                    'choices' => [
                        'baño' => 'baño completo',
                        'corte' => 'cort de cabello',
                    ],
                    'placeholder' => 'Seleciona el aseo que ofreces', 
            ])
            ->add('Precio')
            ->add('descripcion')
            ->add('paseo', ChoiceType::class,[
                    'choices' => [
                        'Si' => 'si',
                        'No' => 'no',
                    ],
                    'placeholder' => 'Seleciona...', 
            ])

            ->add('imageFile', VichImageType::class)

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Paquete::class,
        ]);
    }
}
