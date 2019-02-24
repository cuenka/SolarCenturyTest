<?php

namespace App\Form;

use App\Entity\Company;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class CompanyType
 * @package App\Form
 */
class CompanyType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'required' => true,
                'attr' => [
                    'class' => 'mt-1',
                    'placeholder' => 'company name',
                ],
            ])->add('headquarters', TextType::class, [
                'required' => true,
                'attr' => [
                    'class' => 'mt-1',
                    'placeholder' => 'Headquarters information',
                ],
            ])->add('founded', DateType::class, [
                'required' => true,
                'format' => 'dd-MM-yyyy',
                'html5' => true,
                'attr' => [
                    'type' => 'date',
                    'class' => 'mt-1',
                    'placeholder' => 'Headquarters information',
                ],
            ])->add('save', SubmitType::class, [
                    'label' => 'Save',
                    'attr' => [
                            'class' => 'btn btn-success mt-1',
                        ],
                ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Company::class,
        ]);
    }
}
