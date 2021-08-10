<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\AdressRepository;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=AdressRepository::class)
 */
class Adress
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("linkApiProfile")
     */
    private $fullName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("linkApiProfile")
     */
    private $company;

    /**
     * @ORM\Column(type="text")
     * @Groups("linkApiProfile")
     */
    private $adress;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups("linkApiProfile")
     */
    private $complement;

    /**
     * @ORM\Column(type="integer")
     * @Groups("linkApiProfile")
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("linkApiProfile")
     */
    private $city;

    /**
     * @ORM\Column(type="integer")
     * @Groups("linkApiProfile")
     */
    private $postalCode;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("linkApiProfile")
     */
    private $country;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="adresses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setFullName(string $fullName): self
    {
        $this->fullName = $fullName;

        return $this;
    }

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(?string $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    public function getComplement(): ?string
    {
        return $this->complement;
    }

    public function setComplement(?string $complement): self
    {
        $this->complement = $complement;

        return $this;
    }

    public function getPhone(): ?int
    {
        return $this->phone;
    }

    public function setPhone(int $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getPostalCode(): ?int
    {
        return $this->postalCode;
    }

    public function setPostalCode(int $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

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
}
