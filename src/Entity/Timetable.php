<?php

namespace App\Entity;

use App\Repository\TimetableRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TimetableRepository::class)
 */
class Timetable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $description;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $monday;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $tuesday;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $wednesday;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $thursday;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $friday;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $saturday;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $sunday;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private ?string $mondayWorkHours;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private ?string $tuesdayWorkHours;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private ?string $wednesdayWorkHours;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private ?string $thursdayWorkHours;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private ?string $fridayWorkHours;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private ?string $saturdayWorkHours;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private ?string $sundayWorkHours;

    /**
     * @ORM\Column(type="datetime")
     */
    private \DateTime $createdAt;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $removed;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="timetable")
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity=Doctor::class, mappedBy="timetable")
     */
    private $doctors;


    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->removed = false;
        $this->users = new ArrayCollection();
        $this->doctors = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return bool
     */
    public function isMonday(): bool
    {
        return $this->monday;
    }

    /**
     * @param bool $monday
     */
    public function setMonday(bool $monday): void
    {
        $this->monday = $monday;
    }

    /**
     * @return bool
     */
    public function isTuesday(): bool
    {
        return $this->tuesday;
    }

    /**
     * @param bool $tuesday
     */
    public function setTuesday(bool $tuesday): void
    {
        $this->tuesday = $tuesday;
    }

    /**
     * @return bool
     */
    public function isWednesday(): bool
    {
        return $this->wednesday;
    }

    /**
     * @param bool $wednesday
     */
    public function setWednesday(bool $wednesday): void
    {
        $this->wednesday = $wednesday;
    }

    /**
     * @return bool
     */
    public function isThursday(): bool
    {
        return $this->thursday;
    }

    /**
     * @param bool $thursday
     */
    public function setThursday(bool $thursday): void
    {
        $this->thursday = $thursday;
    }

    /**
     * @return bool
     */
    public function isFriday(): bool
    {
        return $this->friday;
    }

    /**
     * @param bool $friday
     */
    public function setFriday(bool $friday): void
    {
        $this->friday = $friday;
    }

    /**
     * @return bool
     */
    public function isSaturday(): bool
    {
        return $this->saturday;
    }

    /**
     * @param bool $saturday
     */
    public function setSaturday(bool $saturday): void
    {
        $this->saturday = $saturday;
    }

    /**
     * @return bool
     */
    public function isSunday(): bool
    {
        return $this->sunday;
    }

    /**
     * @param bool $sunday
     */
    public function setSunday(bool $sunday): void
    {
        $this->sunday = $sunday;
    }

    /**
     * @return string|null
     */
    public function getMondayWorkHours(): ?string
    {
        return $this->mondayWorkHours;
    }

    /**
     * @param string|null $mondayWorkHours
     */
    public function setMondayWorkHours(?string $mondayWorkHours): void
    {
        $this->mondayWorkHours = $mondayWorkHours;
    }

    /**
     * @return string|null
     */
    public function getTuesdayWorkHours(): ?string
    {
        return $this->tuesdayWorkHours;
    }

    /**
     * @param string|null $tuesdayWorkHours
     */
    public function setTuesdayWorkHours(?string $tuesdayWorkHours): void
    {
        $this->tuesdayWorkHours = $tuesdayWorkHours;
    }

    /**
     * @return string|null
     */
    public function getWednesdayWorkHours(): ?string
    {
        return $this->wednesdayWorkHours;
    }

    /**
     * @param string|null $wednesdayWorkHours
     */
    public function setWednesdayWorkHours(?string $wednesdayWorkHours): void
    {
        $this->wednesdayWorkHours = $wednesdayWorkHours;
    }

    /**
     * @return string|null
     */
    public function getThursdayWorkHours(): ?string
    {
        return $this->thursdayWorkHours;
    }

    /**
     * @param string|null $thursdayWorkHours
     */
    public function setThursdayWorkHours(?string $thursdayWorkHours): void
    {
        $this->thursdayWorkHours = $thursdayWorkHours;
    }

    /**
     * @return string|null
     */
    public function getFridayWorkHours(): ?string
    {
        return $this->fridayWorkHours;
    }

    /**
     * @param string|null $fridayWorkHours
     */
    public function setFridayWorkHours(?string $fridayWorkHours): void
    {
        $this->fridayWorkHours = $fridayWorkHours;
    }

    /**
     * @return string|null
     */
    public function getSaturdayWorkHours(): ?string
    {
        return $this->saturdayWorkHours;
    }

    /**
     * @param string|null $saturdayWorkHours
     */
    public function setSaturdayWorkHours(?string $saturdayWorkHours): void
    {
        $this->saturdayWorkHours = $saturdayWorkHours;
    }

    /**
     * @return string|null
     */
    public function getSundayWorkHours(): ?string
    {
        return $this->sundayWorkHours;
    }

    /**
     * @param string|null $sundayWorkHours
     */
    public function setSundayWorkHours(?string $sundayWorkHours): void
    {
        $this->sundayWorkHours = $sundayWorkHours;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt(\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return bool
     */
    public function isRemoved(): bool
    {
        return $this->removed;
    }

    /**
     * @param bool $removed
     */
    public function setRemoved(bool $removed): void
    {
        $this->removed = $removed;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function isStillOpen(): bool
    {
        [$startAt, $endAt] = explode('-', $this->todayWorkingHours());

        $nowHour = (int)date('H');

        return $nowHour >= (int)$startAt && $nowHour <= (int)$endAt;
    }

    public function todayWorkingHours()
    {
        $today = date('l');

        return $this->{'get'.$today.'WorkHours'}();
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setTimetable($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getTimetable() === $this) {
                $user->setTimetable(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Doctor[]
     */
    public function getDoctors(): Collection
    {
        return $this->doctors;
    }

    public function addDoctor(Doctor $doctor): self
    {
        if (!$this->doctors->contains($doctor)) {
            $this->doctors[] = $doctor;
            $doctor->setTimetable($this);
        }

        return $this;
    }

    public function removeDoctor(Doctor $doctor): self
    {
        if ($this->doctors->removeElement($doctor)) {
            // set the owning side to null (unless already changed)
            if ($doctor->getTimetable() === $this) {
                $doctor->setTimetable(null);
            }
        }

        return $this;
    }

}
