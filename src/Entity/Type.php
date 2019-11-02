<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypeRepository")
 */
class Type
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
     * @ORM\OneToMany(targetEntity="App\Entity\Batch", mappedBy="type")
     */
    private $batch;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Expense", mappedBy="type")
     */
    private $expenses;

    public function __construct()
    {
        $this->batch = new ArrayCollection();
        $this->expenses = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getName();
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

    /**
     * @return Collection|Batch[]
     */
    public function getBatch(): Collection
    {
        return $this->batch;
    }

    public function addBatch(Batch $batch): self
    {
        if (!$this->batch->contains($batch)) {
            $this->batch[] = $batch;
            $batch->setType($this);
        }

        return $this;
    }

    public function removeBatch(Batch $batch): self
    {
        if ($this->batch->contains($batch)) {
            $this->batch->removeElement($batch);
            // set the owning side to null (unless already changed)
            if ($batch->getType() === $this) {
                $batch->setType(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Expense[]
     */
    public function getExpenses(): Collection
    {
        return $this->expenses;
    }

    public function addExpense(Expense $expense): self
    {
        if (!$this->expenses->contains($expense)) {
            $this->expenses[] = $expense;
            $expense->setType($this);
        }

        return $this;
    }

    public function removeExpense(Expense $expense): self
    {
        if ($this->expenses->contains($expense)) {
            $this->expenses->removeElement($expense);
            // set the owning side to null (unless already changed)
            if ($expense->getType() === $this) {
                $expense->setType(null);
            }
        }

        return $this;
    }
}
