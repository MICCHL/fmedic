<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('firstname')
            ->add('lastname')
        ;

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) use ($builder){

            /** @var User $user */
            $user = $event->getData();

            if (in_array('ROLE_ADMIN', $user->getRoles())) {

                $builder
                    ->add('roles', ChoiceType::class, [
                        'required' => true,
                        'multiple' => false,
                        'expanded' => false,
                        'choices'  => [
                            'Pacjent' => 'ROLE_USER',
                            'Lekarz' => 'ROLE_DOCTOR',
                            'Administrator' => 'ROLE_ADMIN',
                        ],
                    ])
                    ->add('blocked');



                $builder->get('roles')
                    ->addModelTransformer(new CallbackTransformer(
                        function ($rolesArray) {
                            // transform the array to a string
                            return count($rolesArray)? $rolesArray[0]: null;
                        },
                        function ($rolesString) {
                            // transform the string back to an array
                            return [$rolesString];
                        }
                    ));

            }


        });


    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
