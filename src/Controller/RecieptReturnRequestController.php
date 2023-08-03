<?php

namespace App\Controller;

use App\Entity\RecieptReturnRequest;
use App\Form\RecieptReturnRequestType;
use App\Repository\RecieptReturnRequestRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/reciept/return/request')]
class RecieptReturnRequestController extends AbstractController
{
    #[Route('/', name: 'app_reciept_return_request_index', methods: ['GET'])]
    public function index(RecieptReturnRequestRepository $recieptReturnRequestRepository): Response
    {
        return $this->render('reciept_return_request/index.html.twig', [
            'reciept_return_requests' => $recieptReturnRequestRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_reciept_return_request_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $recieptReturnRequest = new RecieptReturnRequest();
        $form = $this->createForm(RecieptReturnRequestType::class, $recieptReturnRequest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($recieptReturnRequest);
            $entityManager->flush();

            return $this->redirectToRoute('app_reciept_return_request_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reciept_return_request/new.html.twig', [
            'reciept_return_request' => $recieptReturnRequest,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_reciept_return_request_show', methods: ['GET'])]
    public function show(RecieptReturnRequest $recieptReturnRequest): Response
    {
        return $this->render('reciept_return_request/show.html.twig', [
            'reciept_return_request' => $recieptReturnRequest,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_reciept_return_request_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, RecieptReturnRequest $recieptReturnRequest, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RecieptReturnRequestType::class, $recieptReturnRequest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_reciept_return_request_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reciept_return_request/edit.html.twig', [
            'reciept_return_request' => $recieptReturnRequest,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_reciept_return_request_delete', methods: ['POST'])]
    public function delete(Request $request, RecieptReturnRequest $recieptReturnRequest, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$recieptReturnRequest->getId(), $request->request->get('_token'))) {
            $entityManager->remove($recieptReturnRequest);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_reciept_return_request_index', [], Response::HTTP_SEE_OTHER);
    }
}
