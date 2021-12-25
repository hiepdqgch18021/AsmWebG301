<?php

namespace App\Entity;

use App\Repository\SubjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SubjectRepository::class)
 */
class Subject
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $subjectID;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="date")
     */
    private $schedule;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $material;

    /**
     * @ORM\ManyToOne(targetEntity=Semester::class, inversedBy="subjects")
     */
    private $semester;

    /**
     * @ORM\ManyToMany(targetEntity=ClassRoom::class, inversedBy="subjects")
     */
    private $Class;

    public function __construct()
    {
        $this->Class = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSubjectID(): ?string
    {
        return $this->subjectID;
    }

    public function setSubjectID(string $subjectID): self
    {
        $this->subjectID = $subjectID;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSchedule(): ?\DateTimeInterface
    {
        return $this->schedule;
    }

    public function setSchedule(\DateTimeInterface $schedule): self
    {
        $this->schedule = $schedule;

        return $this;
    }

    public function getMaterial(): ?string
    {
        return $this->material;
    }

    public function setMaterial(string $material): self
    {
        $this->material = $material;

        return $this;
    }

    public function getSemester(): ?Semester
    {
        return $this->semester;
    }

    public function setSemester(?Semester $semester): self
    {
        $this->semester = $semester;

        return $this;
    }

    /**
     * @return Collection|ClassRoom[]
     */
    public function getClass(): Collection
    {
        return $this->Class;
    }

    public function addClass(ClassRoom $class): self
    {
        if (!$this->Class->contains($class)) {
            $this->Class[] = $class;
        }

        return $this;
    }

    public function removeClass(ClassRoom $class): self
    {
        $this->Class->removeElement($class);

        return $this;
    }
}
