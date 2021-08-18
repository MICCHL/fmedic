<?php

namespace App\Form;

use App\Entity\Timetable;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Regex;

class TimetableType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('description', TextType::class, [
                'label' => 'Opis'
            ])
            ->add('monday', CheckboxType::class, [
                'required' => false,
                'label' => 'Poniedziałek'
            ])
            ->add('tuesday', CheckboxType::class, [
                'required' => false,
                'label' => 'Wtorek'
            ])
            ->add('wednesday', CheckboxType::class, [
                'required' => false,
                'label' => 'Środa'
            ])
            ->add('thursday', CheckboxType::class, [
                'required' => false,
                'label' => 'Czwartek'
            ])
            ->add('friday', CheckboxType::class, [
                'required' => false,
                'label' => 'Piątek'
            ])
            ->add('saturday', CheckboxType::class, [
                'required' => false,
                'label' => 'Sobota'
            ])
            ->add('sunday', CheckboxType::class, [
                'required' => false,
                'label' => 'Niedziela'
            ])
            ->add('mondayWorkHours', TextType::class, $this->optionsForWorkHours())
            ->add('tuesdayWorkHours', TextType::class, $this->optionsForWorkHours())
            ->add('wednesdayWorkHours', TextType::class, $this->optionsForWorkHours())
            ->add('thursdayWorkHours', TextType::class, $this->optionsForWorkHours())
            ->add('fridayWorkHours', TextType::class, $this->optionsForWorkHours())
            ->add('saturdayWorkHours', TextType::class, $this->optionsForWorkHours())
            ->add('sundayWorkHours', TextType::class, $this->optionsForWorkHours())
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Timetable::class,
        ]);
    }

    private function optionsForWorkHours(): array
    {
        return [
            'required' => false,
            'label' => 'Godziny pracy',
            'attr' => [
                'placeholder' => '00-24',
            ],
            'constraints' => [
                new Regex('/[0-9]{2}-[0-9]{2}/')
            ]
        ];
    }
}
