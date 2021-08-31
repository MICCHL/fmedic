<?php


namespace App\Controller;


use App\Entity\Doctor;
use App\Entity\Visit;
use App\Form\VisitType;
use App\Service\TimetableInformant;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

/**
 * @Route("/visit/{doctor}", name="visit_doctor_")
 */
class DoctorVisitController extends AbstractController
{
    /**
     * @Route("/", name="week", methods={"GET"})
     */
    public function weekTimetable(Doctor $doctor): Response
    {
        return $this->render('doctor/weekTimetable.html.twig', [
            'doctor' => $doctor,
            'timetableStart' => new \DateTime(),
            'timetableEnd' => new \DateTime('+7 day')
        ]);
    }

    /**
     * @Route("/{date}", name="day", methods={"GET"})
     */
    public function dayTimetable(Doctor $doctor, string $date, TimetableInformant $informant): Response
    {
        return $this->render('doctor/hourTimetable.html.twig', [
            'doctor' => $doctor,
            'selectedDate' => $date,
            'availableHours' => $informant->getAvailableHours($doctor, $date)
        ]);
    }


    /**
     * @Route("/{date}/{hour}/book", name="book", methods={"GET", "POST"})
     */
    public function book(Doctor $doctor, string $date, string $hour, Request $request, Security $security): Response
    {

        $visit = new Visit();

        $visit->setDoctor($doctor)
            ->setStatus(0)
            ->setPatient($security->getUser())
            ->setDate(new \DateTimeImmutable($date . ' ' . $hour . ':00:00'));

        $form = $this->createForm(VisitType::class, $visit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($visit);
            $entityManager->flush();

            return $this->redirectToRoute('visit_list');
        }

        return $this->render('doctor/newVisit.html.twig', [
            'visit' => $visit,
            'form' => $form->createView()
        ]);
    }
}