<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('password')
            ->add('gender', ChoiceType::class,[
                'choices' => [
                    'female' => 'female',
                    'male' => 'male',
                    'transgender' => 'transgender',
                ],
            ])
            ->add('firstName')
            ->add('lastName')
            ->add('phoneNumber')
            ->add('profilePicture')
            ->add('currentLocation')
            ->add('address')
            ->add('country')
            ->add('nationality')
            ->add('birthDate')
            ->add('birthPlace')
            ->add('passport', CheckboxType::class,  array('required' => false))
            ->add('passport_file', FileType::class, [
                'label' => 'Passport (pdf file)',
                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,

                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'application/pdf',
                            'application/x-pdf',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid PDF document',
                    ])
                ],
            ])
            ->add('resume', FileType::class, [
                'label' => 'CV (pdf file)',
                 // unmapped means that this field is not associated to any entity property
                 'mapped' => false,

                 // make it optional so you don't have to re-upload the PDF file
                 // every time you edit the Product details
                 'required' => false,
 
                 // unmapped fields can't define their validation using annotations
                 // in the associated entity, so you can use the PHP constraint classes
                 'constraints' => [
                     new File([
                         'maxSize' => '1024k',
                         'mimeTypes' => [
                             'application/pdf',
                             'application/x-pdf',
                         ],
                         'mimeTypesMessage' => 'Please upload a valid PDF document',
                     ])
                 ],
            ])
            ->add('experience', ChoiceType::class,[
                'choices' => [
                    '0-6 months' => '0-6 months',
                    '6 months - 1 year' => '6 months - 1 year',
                    '1-2 years' => '1-2 years',
                    '2+ years' => '2+ years',
                    '5+ years' => '5+ years',
                    '10+ years' => '10+ years',
                ],
            ])
            ->add('description', TextareaType::class, [
                'row_attr' => ['class' => 'text-editor', 'id' => '...'],
                'attr' => ['class' => 'tinymce'],])
            ->add('note')
            ->add('createdAt', DateType::class, [
                'widget' => 'single_text',
                'input'  => 'datetime_immutable',
                'required'   => false,
            ])
            ->add('updatedAt', DateType::class, [
                'widget' => 'single_text',
                'input'  => 'datetime_immutable',
                'required'   => false,
            ])
            ->add('isAdmin')
            ->add('availability')
            ->add('jobCategory', ChoiceType::class,[
                'choices' => [
                    'Commercial' => 'Commercial',
                    'Retail sales' => 'Retail sales',
                    'Creative' => 'Creative',
                    'Technology' => 'Technology',
                    'Marketing & PR' => 'Marketing & PR',
                    'Fashion & luxury' => 'Fashion & luxury',
                    'Management & HR' => 'Management & HR'
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
