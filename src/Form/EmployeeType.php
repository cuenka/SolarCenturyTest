<?php

namespace App\Form;

use App\Entity\Company;
use App\Entity\Employee;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class EmployeeType
 * @package App\Form
 */
class EmployeeType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, [
                'required' => true,
                'attr' => [
                    'class' => 'mt-1',
                    'placeholder' => 'first name',
                ],
            ])->add('lastName', TextType::class, [
                'required' => true,
                'attr' => [
                    'class' => 'mt-1',
                    'placeholder' => 'first name',
                ],
            ])
            ->add('company', EntityType::class, [
                    'required' => true,
                    'class' => Company::class,
                    'choice_label' => function (Company $entity = null) {
                        return $entity ? $entity->getName() : '';
                    },
                    'choice_value' => function (Company $entity = null) {
                        return $entity ? $entity->getId() : '';
                    },
                    'attr' => array(
                        'class' => 'mt-1'
                    )
                ])->add('save', SubmitType::class, [
                'label' => 'Save',
                'attr' => [
                    'class' => 'btn btn-success mt-1',
                ]]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Employee::class,
        ]);
    }
}
