<?php

namespace App\Form;

use App\Entity\Annonces;
use App\Entity\Prestataires;
use DateTime;
use Doctrine\DBAL\Types\DateTimeType as TypesDateTimeType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnnoncesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // $prestataire= $options['prestataire'];
        $builder
            ->add('title')
            // ->add('createdat')
            ->add('createdat',  DateTimeType::class, [
                'label'=>"Date de création ",
                'attr' => [
                    'class' => 'btn btn-block pt-2 mt-3 col'
                ]
            ]
            
            )
            ->add('description')
            // ->add('photo')
            ->add('photo', FileType::class, [
                'label' => 'Votre photo de profile (facultative)',
                'attr'=>['placeholder'=>'Merci de charger une image pour votre profile'],   // unmapped means that this field is not associated to any entity property
                'mapped' => false,
                'required' => false,     
            ])
            ->add('prix')
            ->add('prestataire')

            ->add('submiti', SubmitType::class,
            [
                'label'=>"Valider la commande",
                'attr' => [
                    'class' => 'btn btn-success btn-block pt-2 mt-3'
                ]
            ] )
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Annonces::class,
        ]);
    }
}
