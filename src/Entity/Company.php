<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Name of tables always with a prefix so we avoid reserved words
 * @ORM\Table(name="sc_company", indexes={@ORM\Index(name="company_idx", columns={"company_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\CompanyRepository")
 */
class Company
{
    public const NAME = 'company';

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer", name="company_id")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", name="company_date_created")
     * @Assert\NotNull
     */
    private $dateCreated;

    /**
     * @ORM\Column(type="datetime", name="company_date_modified")
     * @Assert\NotBlank
     */
    private $dateModified;

    /**
     * @ORM\Column(type="string", length=200, name="company_name")
     * @Assert\NotNull
     * @Assert\Length(
     *      min = 2,
     *      max = 200,
     *      minMessage = "Company name must be at least {{ limit }} characters long",
     *      maxMessage = "Company name cannot be longer than {{ limit }} characters"
     * )
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, name="company_headquarters")
     * @Assert\NotNull
     * @Assert\Length(
     *      min = 2,
     *      max = 255,
     *      minMessage = "Headquarters be at least {{ limit }} characters long",
     *      maxMessage = "Headquarters cannot be longer than {{ limit }} characters"
     * )
     */
    private $headquarters;

    /**
     * @ORM\Column(type="datetime", nullable=true, name="company_founded")
     * @Assert\Date
     * @var \DateTimeInterface "d-m-Y" formatted value
     */
    private $founded;

    /**
     * One Company has many employees/staff. This is the inverse side.
     * @ORM\OneToMany(targetEntity="Employee", mappedBy="company")
     */
    private $staff;

    /**
     * Company constructor.
     */
    public function __construct() {
        $this->staff = new ArrayCollection();
        $this->dateCreated = new \DateTime('now');
        $this->dateModified = new \DateTime('now');
    }

    /**
     * @return integer|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Company
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getHeadquarters(): ?string
    {
        return $this->headquarters;
    }

    /**
     * @param string $headquarters
     * @return Company
     */
    public function setHeadquarters(string $headquarters): self
    {
        $this->headquarters = $headquarters;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getFounded(): ?\DateTimeInterface
    {
        return $this->founded;
    }

    /**
     * @param \DateTimeInterface|null $founded
     * @return Company
     */
    public function setFounded(?\DateTimeInterface $founded): self
    {
        $this->founded = $founded;

        return $this;
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
     * @return Company
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
     * @return Company
     */
    public function setDateModified(\DateTimeInterface $dateModified): self
    {
        $this->dateModified = $dateModified;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getStaff() : Collection
    {
        return $this->staff;
    }

    /**
     * @param mixed $staff
     */
    public function setStaff($staff): void
    {
        $this->staff = $staff;
    }


}
