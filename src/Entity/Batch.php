<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $supplier;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Expense", mappedBy="batch")
     */
    private $expenses;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Income", mappedBy="batch")
     */
    private $incomes;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="batches")
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Farm", inversedBy="batches")
     */
    private $farm;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateSoldOut;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $onSale;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $sellingprice;

    public function __construct()
    {
        $this->expenses = new ArrayCollection();
        $this->incomes = new ArrayCollection();
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

    public function getTotalDucks(): ?int
    {
        return $this->getNumberOfFemales() + $this->getNumberOfMales();
    }

    public function getTotalAcquireCost(): ?float
    {
        return ($this->getNumberOfFemales() + $this->getNumberOfMales()) * $this->getCostPerBird();
    }

    public function getSupplier(): ?string
    {
        return $this->supplier;
    }

    public function setSupplier(?string $supplier): self
    {
        $this->supplier = $supplier;

        return $this;
    }

    public function getAge()
    {
        if ($this->getDateSoldOut()) {
            return date_diff($this->getDateAcquired(), $this->getDateSoldOut(), true)->format('%R%a');
        }
        return date_diff($this->getDateAcquired(),new \DateTime(), true)->format('%R%a');
    }

    /**
     * @return Collection|Expense[]
     */
    public function getExpenses(): Collection
    {
        return $this->expenses;
    }

    public function getTotalExpenses()
    {
        $total = 0;
        foreach ($this->expenses as $expense) {
            $total += $expense->getAmount();
        }
        return $total;
    }

    public function addExpense(Expense $expense): self
    {
        if (!$this->expenses->contains($expense)) {
            $this->expenses[] = $expense;
            $expense->setBatch($this);
        }

        return $this;
    }

    public function removeExpense(Expense $expense): self
    {
        if ($this->expenses->contains($expense)) {
            $this->expenses->removeElement($expense);
            // set the owning side to null (unless already changed)
            if ($expense->getBatch() === $this) {
                $expense->setBatch(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Income[]
     */
    public function getIncomes(): Collection
    {
        return $this->incomes;
    }

    public function addIncome(Income $income): self
    {
        if (!$this->incomes->contains($income)) {
            $this->incomes[] = $income;
            $income->setBatch($this);
        }

        return $this;
    }

    public function removeIncome(Income $income): self
    {
        if ($this->incomes->contains($income)) {
            $this->incomes->removeElement($income);
            // set the owning side to null (unless already changed)
            if ($income->getBatch() === $this) {
                $income->setBatch(null);
            }
        }

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getFarm(): ?Farm
    {
        return $this->farm;
    }

    public function setFarm(?Farm $farm): self
    {
        $this->farm = $farm;

        return $this;
    }

    public function getDateSoldOut(): ?\DateTimeInterface
    {
        return $this->dateSoldOut;
    }

    public function setDateSoldOut(?\DateTimeInterface $dateSoldOut): self
    {
        $this->dateSoldOut = $dateSoldOut;

        return $this;
    }

    public function getOnSale(): ?bool
    {
        return $this->onSale;
    }

    public function setOnSale(?bool $onSale): self
    {
        $this->onSale = $onSale;

        return $this;
    }

    public function getSellingprice(): ?int
    {
        return $this->sellingprice;
    }

    public function setSellingprice(?int $sellingprice): self
    {
        $this->sellingprice = $sellingprice;

        return $this;
    }
}
