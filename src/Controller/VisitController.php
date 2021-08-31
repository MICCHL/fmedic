<?php


namespace App\Controller;


use App\Entity\Visit;
use App\Form\DoctorVisitAcceptType;
use App\Repository\VisitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/visits", name="visit_")
 */
class VisitController extends AbstractController
{

    /**
     * @Route("/", name="list", methods={"GET"})
     */
    public function index(VisitRepository $repository): Response
    {
        $visits = [];

        if ($this->isGranted('ROLE_DOCTOR')) {
            $visits = $repository->findDoctorVisit($this->getUser());
        } else {
            $visits = $repository->findUserVisit($this->getUser());
        }

        return $this->render('visit/index.html.twig', [
            'visits' => $visits
        ]);
    }

    /**
     * @Route("/{visit}", name="accept", methods={"GET", "POST"})
     */
    public function accept(Visit $visit, Request $request): Response
    {
        $form = $this->createForm(DoctorVisitAcceptType::class, $visit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $visit->setStatus(1);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($visit);
            $entityManager->flush();

            return $this->redirectToRoute('visit_list');
        }

        return $this->render('visit/patientVisit.html.twig', [
            'visit' => $visit,
            'form' => $form->createView()
        ]);
    }

}