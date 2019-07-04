<?php


namespace App\Form;


use App\Entity\Product;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    /**
     * @param FormBuilderInterface $formBuilder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $formBuilder, array $options)
    {
        $formBuilder
            ->add('nameShort', TextType::class)
            ->add('nameFull', TextType::class)
            ->add('description', TextareaType::class)
            ->add('priceBase', TextType::class)
            ->add('bodySystems', EntityType::class, [
                'class' => 'App\Entity\BodySystem',
                'choice_label' => 'name'
            ])
            ->add('medicationGoals', EntityType::class, [
                'class' => 'App\Entity\MedicationGoal',
                'choice_label' => 'name'
            ])
            ->add('productType', EntityType::class, [
                'class' => 'App\Entity\ProductType',
                'choice_label' => 'name'
            ])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
