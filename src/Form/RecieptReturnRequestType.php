<?php

namespace App\Form;

use App\Entity\RecieptReturnRequest;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecieptReturnRequestType extends AbstractType
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
            ->add('requestedAt')
            ->add('totalPrice')
            ->add('document')
            ->add('approvedAt')
            ->add('recievedAt')
            ->add('createdBy')
            ->add('updatedBy')
            ->add('deletedBy')
            ->add('receiptIssueRequest')
            ->add('requestedBy')
            ->add('approvedBy')
            ->add('recievedBy')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RecieptReturnRequest::class,
        ]);
    }
}
