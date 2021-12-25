<?php

namespace App\Entity;

use App\Repository\ClassRoomRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClassRoomRepository::class)
 */
class ClassRoom
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
    private $ClassID;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $amountStudent;

    /**
     * @ORM\ManyToMany(targetEntity=Teacher::class, mappedBy="Class")
     */
    private $teachers;

    /**
     * @ORM\ManyToMany(targetEntity=Subject::class, mappedBy="Class")
     */
    private $subjects;

    public function __construct()
    {
        $this->teachers = new ArrayCollection();
        $this->subjects = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClassID(): ?string
    {
        return $this->ClassID;
    }

    public function setClassID(string $ClassID): self
    {
        $this->ClassID = $ClassID;

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

    public function getAmountStudent(): ?int
    {
        return $this->amountStudent;
    }

    public function setAmountStudent(int $amountStudent): self
    {
        $this->amountStudent = $amountStudent;

        return $this;
    }

    /**
     * @return Collection|Teacher[]
     */
    public function getTeachers(): Collection
    {
        return $this->teachers;
    }

    public function addTeacher(Teacher $teacher): self
    {
        if (!$this->teachers->contains($teacher)) {
            $this->teachers[] = $teacher;
            $teacher->addClass($this);
        }

        return $this;
    }

    public function removeTeacher(Teacher $teacher): self
    {
        if ($this->teachers->removeElement($teacher)) {
            $teacher->removeClass($this);
        }

        return $this;
    }

    /**
     * @return Collection|Subject[]
     */
    public function getSubjects(): Collection
    {
        return $this->subjects;
    }

    public function addSubject(Subject $subject): self
    {
        if (!$this->subjects->contains($subject)) {
            $this->subjects[] = $subject;
            $subject->addClass($this);
        }

        return $this;
    }

    public function removeSubject(Subject $subject): self
    {
        if ($this->subjects->removeElement($subject)) {
            $subject->removeClass($this);
        }

        return $this;
    }
}
