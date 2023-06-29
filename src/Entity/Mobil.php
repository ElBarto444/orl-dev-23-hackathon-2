<?php

namespace App\Entity;

use App\Repository\MobilRepository;
use DateTimeInterface;
use DateTime;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\Collection;



#[ORM\Entity(repositoryClass: MobilRepository::class)]
#[Vich\Uploadable]
class Mobil
{
    public const PHONE_CONDITION = [
        'DEEE',
        'REPARABLE',
        'BLOQUE',
        'RECONDITIONABLE',
        'RECONDITIONNE'
    ];

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $marque = null;

    #[ORM\Column(length: 255)]
    private ?string $modele = null;

    #[ORM\Column(length: 255, nullable : true)]
    private ?string $categoryName = null;

    #[ORM\ManyToOne(inversedBy: 'mobils')]
    private ?Category $category = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $poster = null;

    #[Vich\UploadableField(mapping: 'poster_file', fileNameProperty: 'poster')]
    #[Assert\File(
        maxSize: '1M',
        mimeTypes: ['image/jpeg', 'image/png', 'image/webp'],
    )]
    private ?File $posterFile = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?DateTimeInterface $updatedAt = null;


    #[ORM\Column(length: 255)]
    private ?string $reseau = null;

    #[ORM\Column]
    private ?string $stockage = null;

    #[ORM\Column(length: 255)]
    private ?string $ecran = null;

    #[ORM\Column(length: 255)]
    private ?string $RAM = null;


    #[ORM\Column(length: 255, nullable: true)]
    private ?string $phoneCondition = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): static
    {
        $this->marque = $marque;

        return $this;
    }

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(string $modele): static
    {
        $this->modele = $modele;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getPoster(): ?string
    {
        return $this->poster;
    }

    public function setPoster(?string $poster): static
    {
        $this->poster = $poster;

        return $this;
    }

    public function getPosterFile(): ?File
    {
        return $this->posterFile;
    }


    public function setPosterFile(File $image = null): Mobil
    {
        $this->posterFile = $image;
        if ($image) {
            $this->updatedAt = new DateTime('now');
        }

        return $this;
    }

     public function getReseau(): ?string
    {
        return $this->reseau;
    }

    public function setReseau(string $reseau): static
    {
        $this->reseau = $reseau;

        return $this;
    }

    public function getStockage(): ?string
    {
        return $this->stockage;
    }

    public function setStockage(string $stockage): static
    {
        $this->stockage = $stockage;

        return $this;
    }

    public function getEcran(): ?string
    {
        return $this->ecran;
    }

    public function setEcran(string $ecran): static
    {
        $this->ecran = $ecran;

        return $this;
    }

    public function getRAM(): ?string
    {
        return $this->RAM;
    }

    public function setRAM(string $RAM): static
    {
        $this->RAM = $RAM;

        return $this;
    }

    /**
     * @return Collection<int, Mobil>
     */
   

    public function getPhoneCondition(): ?string
    {
        return $this->phoneCondition;
    }

    public function setPhoneCondition(string $phoneCondition): static
    {
        $this->phoneCondition = $phoneCondition;

        return $this;
    }

    /**
     * Get the value of categoryName
     *
     * @return ?string
     */
    public function getCategoryName(): ?string
    {
        return $this->categoryName;
    }


    /**
     * Set the value of categoryName
     *
     * @param ?string $categoryName
     *
     * @return self
     */
    public function setCategoryName(?string $categoryName): self
    {
        $this->categoryName = $categoryName;

        return $this;
    }
}
