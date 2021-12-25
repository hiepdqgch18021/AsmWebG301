<?php

namespace App\Entity;

use App\Repository\TeacherRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TeacherRepository::class)
 */
class Teacher
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
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $age;

    /**
     * @ORM\Column(type="float")
     */
    private $salary;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $majors;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $avatar;

    /**
     * @ORM\ManyToMany(targetEntity=ClassRoom::class, inversedBy="teachers")
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getSalary(): ?float
    {
        return $this->salary;
    }

    public function setSalary(float $salary): self
    {
        $this->salary = $salary;

        return $this;
    }

    public function getMajors(): ?string
    {
        return $this->majors;
    }

    public function setMajors(string $majors): self
    {
        $this->majors = $majors;

        return $this;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(string $avatar): self
    {
        $this->avatar = $avatar;

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
