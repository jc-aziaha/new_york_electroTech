<?php

namespace App\Entity;

use App\Repository\AddressRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;




#[ORM\Entity(repositoryClass: AddressRepository::class)]
class Address
{


    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\ManyToOne(inversedBy: 'addresses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;


    #[Assert\NotBlank(message: "La rue est obligatoire.")]
    #[Assert\Length(
        max: 255,
        maxMessage: 'Les informations de la rue ne doivent pas dépasser {{ limit }} caractères.',
    )]
    #[ORM\Column(length: 255)]
    private ?string $street = null;


    #[Assert\NotBlank(message: "Le code postal est obligatoire.")]
    #[Assert\Regex(
        pattern: '/^\d{3,10}$/',
        match: true,
        message: 'Le code postal doit être un nombre compris entre 3 et 10 chiffres.'
    )]
    #[ORM\Column(length: 255)]
    private ?string $postalCode = null;


    #[Assert\NotBlank(message: "La ville est obligatoire.")]
    #[Assert\Length(
        max: 255,
        maxMessage: 'Le nom de la ville ne doit pas dépasser {{ limit }} caractères.',
    )]
    #[ORM\Column(length: 255)]
    private ?string $city = null;


    #[Assert\NotBlank(message: "Le pays est obligatoire.")]
    #[Assert\Length(
        max: 255,
        maxMessage: 'Le nom du pays ne doit pas dépasser {{ limit }} caractères.',
    )]
    #[Assert\Country(message: "Ce pays est inconnu")]
    #[ORM\Column(length: 255)]
    private ?string $country = null;


    #[Assert\Length(
        max: 255,
        maxMessage: 'Le mot clé ne doit pas dépasser {{ limit }} caractères.',
    )]
    #[Assert\Regex(
        pattern: '/^[a-zA-Z0-9\s\-_]+$/',
        match: true,
        message: 'Le code clé n\'est pas valide'
    )]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $keyword = null;


    #[Assert\NotBlank(message: "Le prénom est obligatoire.")]
    #[Assert\Length(
        max: 255,
        maxMessage: 'Le prénom ne doit pas dépasser {{ limit }} caractères.',
    )]
    #[ORM\Column(length: 255)]
    private ?string $firstName = null;


    #[Assert\NotBlank(message: "Le nom est obligatoire.")]
    #[Assert\Length(
        max: 255,
        maxMessage: 'Le nom ne doit pas dépasser {{ limit }} caractères.',
    )]
    #[ORM\Column(length: 255)]
    private ?string $lastName = null;


    #[Assert\NotBlank(message: "Le numéro de téléphone est obligatoire.")]
    #[Assert\Length(
        max: 255,
        maxMessage: 'Le numéro de téléphone ne doit pas dépasser {{ limit }} caractères.',
    )]
    #[Assert\Regex(
        pattern: '/^[0-9\-\+\s\(\)]{6,30}$/',
        match: true,
        message: 'Le numéro de téléphone n\'est pas valide'
    )]
    #[ORM\Column(length: 255)]
    private ?string $phone = null;


    #[Assert\Length(
        max: 255,
        maxMessage: 'Le nom de l\'entreprise ne doit pas dépasser {{ limit }} caractères.',
    )]
    #[Assert\Regex(
        pattern: '/^[a-zA-Z0-9\s-_]+$/',
        match: true,
        message: 'Le nom de la compagine n\'est pas valide'
    )]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $company = null;


    #[Assert\Length(
        max: 2000,
        maxMessage: 'Les détails ne doivent pas dépasser {{ limit }} caractères.',
    )]
    #[Assert\Regex(
        pattern: '/^[a-zA-Z0-9\s-_]+$/',
        match: true,
        message: 'Des caractères ne sont valides dans le détail.'
    )]
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $details = null;


    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $createdAt = null;


    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    
    public function __toString()
    {
        $part1 = $this->getKeyword() ? "{$this->getKeyword()}: [br]" : "";
        $part2 = "{$this->getFirstName()} {$this->getLastName()} --- [br] {$this->getStreet()} {$this->getCity()} {$this->getPostalCode()}, {$this->getCountry()}";

        return "$part1 $part2";


        // return $this->getKeyword() 
        //     ? $this->getKeyword() ? "[br]" . $this->getStreet() . "[br]" . $this->getFirstName() . " " . $this->getLastName() . "[br]"
        //     : "Adresse: [br]" . $this->getStreet() . "[br]" . $this->getFirstName() . " " . $this->getLastName() . "[br]"
        // ;
        // $part2 = "{$this->getFirstName()} {$this->getLastName()}, {$this->getStreet()} [br]";
        // $part3 = "{$this->getPostalCode()} {$this->getCity()}, {$this->getCountry()} [br]";

        // return "$part1 $part2 $part3";
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getKeyword(): ?string
    {
        return $this->keyword;
    }

    public function setKeyword(?string $keyword): static
    {
        $this->keyword = $keyword;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(string $street): static
    {
        $this->street = $street;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(string $postalCode): static
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): static
    {
        $this->country = $country;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(?string $company): static
    {
        $this->company = $company;

        return $this;
    }

    public function getDetails(): ?string
    {
        return $this->details;
    }

    public function setDetails(?string $details): static
    {
        $this->details = $details;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeImmutable $createdAt): static 
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): static 
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}