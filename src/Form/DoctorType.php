<?php

namespace App\Form;

use App\Entity\Doctor;
use App\Entity\Specialization;
use App\Entity\Timetable;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DoctorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('degree')
            ->add('specialization', EntityType::class, [
                'class' => Specialization::class,
                'multiple' => true,
                'expanded' => true,
                'choice_label' => 'name'
            ])
            ->add('timetable', EntityType::class, [
                'class' => Timetable::class,
                'choice_label' => 'description',
                'placeholder' => 'Wybierz grafik'
            ])
            ->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label' => fn(USer $user) => $user->getId() . ' ' . $user->getUsername(),
                'placeholder' => 'Wybierz użytkownika',
                'query_builder' => function(UserRepository $repository) {
                    return $repository->findNotAssignedDoctor();
                }
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Doctor::class,
        ]);
    }
}
