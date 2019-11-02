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
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="integer")
     */
    private $number;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateAcquired;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateSold;

    /**
     * @ORM\Column(type="float")
     */
    private $costPerBird;

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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

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

    public function getDateSold(): ?\DateTimeInterface
    {
        return $this->dateSold;
    }

    public function setDateSold(?\DateTimeInterface $dateSold): self
    {
        $this->dateSold = $dateSold;

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
}
