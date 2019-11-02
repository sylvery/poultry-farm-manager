<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BatchRepository")
 */
class Batch
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateAcquired;

    /**
     * @ORM\Column(type="float")
     */
    private $costPerBird;

    /**
     * @ORM\Column(type="integer")
     */
    private $numberOfMales;

    /**
     * @ORM\Column(type="integer")
     */
    private $numberOfFemales;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Type", inversedBy="batch")
     */
    private $type;

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

    public function getDateAcquired(): ?\DateTimeInterface
    {
        return $this->dateAcquired;
    }

    public function setDateAcquired(\DateTimeInterface $dateAcquired): self
    {
        $this->dateAcquired = $dateAcquired;

        return $this;
    }

    public function getCostPerBird(): ?float
    {
        return $this->costPerBird;
    }

    public function setCostPerBird(float $costPerBird): self
    {
        $this->costPerBird = $costPerBird;

        return $this;
    }

    public function getNumberOfMales(): ?int
    {
        return $this->numberOfMales;
    }

    public function setNumberOfMales(int $numberOfMales): self
    {
        $this->numberOfMales = $numberOfMales;

        return $this;
    }

    public function getNumberOfFemales(): ?int
    {
        return $this->numberOfFemales;
    }

    public function setNumberOfFemales(int $numberOfFemales): self
    {
        $this->numberOfFemales = $numberOfFemales;

        return $this;
    }

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function setType(?Type $type): self
    {
        $this->type = $type;

        return $this;
    }
}
