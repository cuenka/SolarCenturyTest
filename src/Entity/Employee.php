<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="sc_employee", indexes={@ORM\Index(name="employee_idx", columns={"employee_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\EmployeeRepository")
 */
class Employee
{
    public const NAME = 'employee';

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="employee_id")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", name="employee_date_created")
     */
    private $dateCreated;

    /**
     * @ORM\Column(type="datetime", name="employee_date_modified")
     */
    private $dateModified;

    /**
     * @ORM\Column(type="string", length=200, name="employee_first_name")
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255, name="employee_last_name")
     */
    private $lastName;

    /**
     * Many employees/employee work for one company. This is the owning side.
     * @ORM\ManyToOne(targetEntity="Company", inversedBy="employee")
     * @ORM\JoinColumn(name="company_id", referencedColumnName="company_id")
     */
    private $company;

    /**
     * Employee constructor.
     */
    public function __construct()
    {
        $this->dateCreated = new \DateTime('now');
        $this->dateModified = new \DateTime('now');
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getDateCreated(): ?\DateTimeInterface
    {
        return $this->dateCreated;
    }

    /**
     * @param \DateTimeInterface $dateCreated
     * @return Employee
     */
    public function setDateCreated(\DateTimeInterface $dateCreated): self
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getDateModified(): ?\DateTimeInterface
    {
        return $this->dateModified;
    }

    /**
     * @param \DateTimeInterface $dateModified
     * @return Employee
     */
    public function setDateModified(\DateTimeInterface $dateModified): self
    {
        $this->dateModified = $dateModified;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return Employee
     */
    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * @return Employee
     */
    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @return Company
     */
    public function getCompany(): ?Company
    {
        return $this->company;
    }

    /**
     * @param Company $company
     * @return Employee
     */
    public function setCompany(Company $company): self
    {
        $this->company = $company;

        return $this;
    }
}
