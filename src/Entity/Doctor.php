<?php

namespace App\Entity;

use App\Repository\DoctorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DoctorRepository::class)
 */
class Doctor
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=Specialization::class, inversedBy="doctors")
     */
    private $specialization;

    /**
     * @ORM\ManyToOne(targetEntity=Timetable::class, inversedBy="doctors")
     */
    private $timetable;

    /**
     * @ORM\OneToOne(targetEntity=User::class, cascade={"persist", "remove"})
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $degree;

    public function __construct()
    {
        $this->specialization = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Specialization[]
     */
    public function getSpecialization(): Collection
    {
        return $this->specialization;
    }

    public function addSpecialization(Specialization $specialization): self
    {
        if (!$this->specialization->contains($specialization)) {
            $this->specialization[] = $specialization;
        }

        return $this;
    }

    public function removeSpecialization(Specialization $specialization): self
    {
        $this->specialization->removeElement($specialization);

        return $this;
    }

    public function getTimetable(): ?Timetable
    {
        return $this->timetable;
    }

    public function setTimetable(?Timetable $timetable): self
    {
        $this->timetable = $timetable;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getDegree(): ?string
    {
        return $this->degree;
    }

    public function setDegree(string $degree): self
    {
        $this->degree = $degree;

        return $this;
    }
}
