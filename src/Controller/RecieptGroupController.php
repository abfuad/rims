<?php

namespace App\Controller;

use App\Entity\RecieptGroup;
use App\Form\RecieptGroupType;
use App\Repository\RecieptGroupRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/reciept-group')]
class RecieptGroupController extends AbstractController
{
    #[Route('/', name: 'app_reciept_group_index', methods: ['GET'])]
    public function index(RecieptGroupRepository $recieptGroupRepository): Response
    {
        return $this->render('reciept_group/index.html.twig', [
            'reciept_groups' => $recieptGroupRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_reciept_group_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $recieptGroup = new RecieptGroup();
        $form = $this->createForm(RecieptGroupType::class, $recieptGroup);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($recieptGroup);
            $entityManager->flush();

            return $this->redirectToRoute('app_reciept_group_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reciept_group/new.html.twig', [
            'reciept_group' => $recieptGroup,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_reciept_group_show', methods: ['GET'])]
    public function show(RecieptGroup $recieptGroup): Response
    {
        return $this->render('reciept_group/show.html.twig', [
            'reciept_group' => $recieptGroup,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_reciept_group_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, RecieptGroup $recieptGroup, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RecieptGroupType::class, $recieptGroup);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_reciept_group_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reciept_group/edit.html.twig', [
            'reciept_group' => $recieptGroup,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_reciept_group_delete', methods: ['POST'])]
    public function delete(Request $request, RecieptGroup $recieptGroup, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$recieptGroup->getId(), $request->request->get('_token'))) {
            $entityManager->remove($recieptGroup);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_reciept_group_index', [], Response::HTTP_SEE_OTHER);
    }
}
