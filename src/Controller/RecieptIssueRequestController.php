<?php

namespace App\Controller;

use App\Entity\RecieptIssueRequest;
use App\Form\RecieptIssueRequestType;
use App\Repository\RecieptIssueRequestRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/reciept/issue/request')]
class RecieptIssueRequestController extends AbstractController
{
    #[Route('/', name: 'app_reciept_issue_request_index', methods: ['GET'])]
    public function index(RecieptIssueRequestRepository $recieptIssueRequestRepository): Response
    {
        return $this->render('reciept_issue_request/index.html.twig', [
            'reciept_issue_requests' => $recieptIssueRequestRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_reciept_issue_request_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $recieptIssueRequest = new RecieptIssueRequest();
        $form = $this->createForm(RecieptIssueRequestType::class, $recieptIssueRequest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($recieptIssueRequest);
            $entityManager->flush();

            return $this->redirectToRoute('app_reciept_issue_request_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reciept_issue_request/new.html.twig', [
            'reciept_issue_request' => $recieptIssueRequest,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_reciept_issue_request_show', methods: ['GET'])]
    public function show(RecieptIssueRequest $recieptIssueRequest): Response
    {
        return $this->render('reciept_issue_request/show.html.twig', [
            'reciept_issue_request' => $recieptIssueRequest,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_reciept_issue_request_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, RecieptIssueRequest $recieptIssueRequest, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RecieptIssueRequestType::class, $recieptIssueRequest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_reciept_issue_request_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reciept_issue_request/edit.html.twig', [
            'reciept_issue_request' => $recieptIssueRequest,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_reciept_issue_request_delete', methods: ['POST'])]
    public function delete(Request $request, RecieptIssueRequest $recieptIssueRequest, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$recieptIssueRequest->getId(), $request->request->get('_token'))) {
            $entityManager->remove($recieptIssueRequest);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_reciept_issue_request_index', [], Response::HTTP_SEE_OTHER);
    }
}
