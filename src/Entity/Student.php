<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StudentRepository::class)
 */
class Student
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $studentID;

    /**
     * @ORM\OneToOne(targetEntity=StudentDetail::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $studentDetail;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStudentID(): ?string
    {
        return $this->studentID;
    }

    public function setStudentID(string $studentID): self
    {
        $this->studentID = $studentID;

        return $this;
    }

    public function getStudentDetail(): ?StudentDetail
    {
        return $this->studentDetail;
    }

    public function setStudentDetail(StudentDetail $studentDetail): self
    {
        $this->studentDetail = $studentDetail;

        return $this;
    }
}
