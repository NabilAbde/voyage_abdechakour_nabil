<?php

namespace App\Form;

use App\Entity\Voyage;
use App\Entity\Tag;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VoyageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('categorie',
                EntityType::class,
                array(
                    'class' => Category::class,
                    'choice_label' => 'name',
                    'multiple' => false,))
             ->add('tag',EntityType::class,[
                    'class' => Tag::class,
                    'choice_label' => 'name',
                    'multiple' => true,])
            ->add('accroche')
            ->add('description')
            ->add('priceperperson')
            ->add('duree')
            ->add('image1')
            ->add('image2')
            ->add('image3')
            ->add('documentation');
       
    } 

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Voyage::class,
        ]);
    }
}
