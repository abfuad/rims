<?php

namespace App\Form;

use App\Entity\RecieptIssueRequest;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecieptIssueRequestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('code')
            ->add('description')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('startNumber')
            ->add('endNumber')
            ->add('exceptional')
            ->add('requestDocument')
            ->add('requestedAt')
            ->add('approvedAt')
            ->add('recievedAt')
            ->add('createdBy')
            ->add('updatedBy')
            ->add('deletedBy')
            ->add('office')
            ->add('approvedBy')
            ->add('givenBy')
            ->add('recievedBy')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RecieptIssueRequest::class,
        ]);
    }
}
