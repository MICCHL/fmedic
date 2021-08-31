<?php


namespace App\Service;


use App\Entity\Doctor;
use App\Entity\Visit;
use App\Repository\VisitRepository;

class TimetableInformant
{
    private VisitRepository $visitRepository;

    /**
     * TimetableInformant constructor.
     * @param VisitRepository $visitRepository
     */
    public function __construct(VisitRepository $visitRepository)
    {
        $this->visitRepository = $visitRepository;
    }

    public function getAvailableHours(Doctor $doctor, string $date): array
    {
        $day = new \DateTimeImmutable($date);
        return  $this->generateSlotForDay($doctor, $day);
    }

    private function generateSlotForDay(Doctor $doctor, \DateTimeImmutable $day): array
    {
        $timetable = $doctor->getTimetable();
        $dayName = $day->format('l');
        $slots = [];

        if ($timetable->{'is' . $dayName}() === false) {
            return $slots;
        }

        $workingHours = explode('-', $timetable->{'get' . $dayName . 'WorkHours'}());
        $startAt = (int)$workingHours[0];
        $endAt = (int)$workingHours[1];

        if (date('H') > $startAt) {
            $startAt = (int)date('G') + 1;
        }

        while ($startAt <= $endAt) {
            $slots[$startAt] = true;
            $startAt+=1;
        }

        $appointments  = $this->appointments($doctor, $day, $workingHours[0], $workingHours[1]);

        /** @var Visit $appointment */
        foreach ($appointments as $appointment) {
            $bookedHour = (int)$appointment->getDate()->format('G');

            if (isset($slots[$bookedHour])) {
                unset($slots[$bookedHour]);
            }
        }

        return $slots;
    }

    private function appointments(Doctor $doctor, \DateTimeImmutable $day, string $startAt, string $endAt)
    {
        return $this->visitRepository->findBookedVisits(
            $doctor,
            new \DateTimeImmutable(
                $day->format('Y-m-d ' . $startAt . ':00:00')
            ),
            new \DateTimeImmutable(
                $day->format('Y-m-d ' . $endAt . ':00:00')
            ),
        );
    }

}