<?php

namespace App\Controller;

use App\Entity\Specialization;
use App\Form\SpecializationType;
use App\Repository\SpecializationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/specialization")
 */
class SpecializationController extends AbstractController
{
    /**
     * @Route("/", name="specialization_index", methods={"GET"})
     */
    public function index(SpecializationRepository $specializationRepository): Response
    {
        return $this->render('specialization/index.html.twig', [
            'specializations' => $specializationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="specialization_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $specialization = new Specialization();
        $form = $this->createForm(SpecializationType::class, $specialization);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($specialization);
            $entityManager->flush();

            return $this->redirectToRoute('specialization_index');
        }

        return $this->render('specialization/new.html.twig', [
            'specialization' => $specialization,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="specialization_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Specialization $specialization): Response
    {
        $form = $this->createForm(SpecializationType::class, $specialization);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('specialization_index');
        }

        return $this->render('specialization/edit.html.twig', [
            'specialization' => $specialization,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="specialization_delete", methods={"POST"})
     */
    public function delete(Request $request, Specialization $specialization): Response
    {
        if ($this->isCsrfTokenValid('delete'.$specialization->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($specialization);
            $entityManager->flush();
        }

        return $this->redirectToRoute('specialization_index');
    }
}
