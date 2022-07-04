<?php

namespace App\Entity;

use App\Repository\RentalOrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RentalOrderRepository::class)]
class RentalOrder
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Station::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $startStation;

    #[ORM\ManyToOne(targetEntity: Station::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $endStation;

    #[ORM\Column(type: 'datetime')]
    private $startDate;

    #[ORM\Column(type: 'datetime')]
    private $endDate;

    #[ORM\OneToMany(mappedBy: 'rentalOrders', targetEntity: RentalOrderEquipment::class)]
    private $equipments;

    #[ORM\ManyToOne(targetEntity: Campervan::class, inversedBy: 'rentalOrder')]
    #[ORM\JoinColumn(nullable: false)]
    private $campervan;

    public function __construct()
    {
        $this->equipments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartStation(): ?Station
    {
        return $this->startStation;
    }

    public function setStartStation(Station $startStation): self
    {
        $this->startStation = $startStation;

        return $this;
    }

    public function getEndStation(): ?Station
    {
        return $this->endStation;
    }

    public function setEndStation(Station $endStation): self
    {
        $this->endStation = $endStation;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * @return Collection<int, RentalOrderEquipment>
     */
    public function getEquipments(): Collection
    {
        return $this->equipments;
    }

    public function addEquipment(RentalOrderEquipment $equipment): self
    {
        if (!$this->equipments->contains($equipment)) {
            $this->equipments[] = $equipment;
            $equipment->setRentalOrders($this);
        }

        return $this;
    }

    public function removeEquipment(RentalOrderEquipment $equipment): self
    {
        if ($this->equipments->removeElement($equipment)) {
            // set the owning side to null (unless already changed)
            if ($equipment->getRentalOrders() === $this) {
                $equipment->setRentalOrders(null);
            }
        }

        return $this;
    }

    public function getCampervan(): ?Campervan
    {
        return $this->campervan;
    }

    public function setCampervan(?Campervan $campervan): self
    {
        $this->campervan = $campervan;

        return $this;
    }
}
