<?php

namespace App\Controller;

use App\Entity\Office;
use App\Form\OfficeType;
use App\Repository\OfficeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/office')]
class OfficeController extends AbstractController
{
    #[Route('/', name: 'app_office_index', methods: ['GET'])]
    public function index(OfficeRepository $officeRepository): Response
    {
        return $this->render('office/index.html.twig', [
            'offices' => $officeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_office_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $office = new Office();
        $form = $this->createForm(OfficeType::class, $office);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($office);
            $entityManager->flush();

            return $this->redirectToRoute('app_office_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('office/new.html.twig', [
            'office' => $office,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_office_show', methods: ['GET'])]
    public function show(Office $office): Response
    {
        return $this->render('office/show.html.twig', [
            'office' => $office,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_office_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Office $office, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(OfficeType::class, $office);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_office_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('office/edit.html.twig', [
            'office' => $office,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_office_delete', methods: ['POST'])]
    public function delete(Request $request, Office $office, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$office->getId(), $request->request->get('_token'))) {
            $entityManager->remove($office);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_office_index', [], Response::HTTP_SEE_OTHER);
    }
}
