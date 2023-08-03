<?php

namespace App\Form;

use App\Entity\Office;
use App\Entity\UserInfo;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserInfoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $role=["System Admin" => "System Admin","Store Keeper"=>"Store Keeper"];

       BaseFormType::userForm($builder);
      $builder ->add('roles', ChoiceType::class,["choices" => $role,'mapped'=>false,"multiple"=>true,"placeholder"=>"Select Role"])
      ->add('office',EntityType::class,[
        'class'=>Office::class,
        'placeholder'=>'choose office'

    ])
    
      ;



    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UserInfo::class,
        ]);
    }
}
