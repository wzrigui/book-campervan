<?php

namespace App\Entity;

use App\Repository\EquipmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EquipmentRepository::class)]
class Equipment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'text', nullable: true)]
    private $description;

    #[ORM\OneToMany(mappedBy: 'equipments', targetEntity: RentalOrderEquipment::class)]
    private $rentalOrders;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $orderQuantityLimit;

    #[ORM\OneToMany(mappedBy: 'equipment', targetEntity: StationEquipment::class)]
    private $equipmentStation;

    public function __construct()
    {
        $this->rentalOrders = new ArrayCollection();
        $this->equipmentStation = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, RentalOrderEquipment>
     */
    public function getRentalOrders(): Collection
    {
        return $this->rentalOrders;
    }

    public function addRentalOrder(RentalOrderEquipment $rentalOrder): self
    {
        if (!$this->rentalOrders->contains($rentalOrder)) {
            $this->rentalOrders[] = $rentalOrder;
            $rentalOrder->setEquipments($this);
        }

        return $this;
    }

    public function removeRentalOrder(RentalOrderEquipment $rentalOrder): self
    {
        if ($this->rentalOrders->removeElement($rentalOrder)) {
            // set the owning side to null (unless already changed)
            if ($rentalOrder->getEquipments() === $this) {
                $rentalOrder->setEquipments(null);
            }
        }

        return $this;
    }

    public function getOrderQuantityLimit(): ?int
    {
        return $this->orderQuantityLimit;
    }

    public function setOrderQuantityLimit(?int $orderQuantityLimit): self
    {
        $this->orderQuantityLimit = $orderQuantityLimit;

        return $this;
    }

    /**
     * @return Collection<int, StationEquipment>
     */
    public function getEquipmentStation(): Collection
    {
        return $this->equipmentStation;
    }

    public function addEquipmentStation(StationEquipment $equipmentStation): self
    {
        if (!$this->equipmentStation->contains($equipmentStation)) {
            $this->equipmentStation[] = $equipmentStation;
            $equipmentStation->setEquipment($this);
        }

        return $this;
    }

    public function removeEquipmentStation(StationEquipment $equipmentStation): self
    {
        if ($this->equipmentStation->removeElement($equipmentStation)) {
            // set the owning side to null (unless already changed)
            if ($equipmentStation->getEquipment() === $this) {
                $equipmentStation->setEquipment(null);
            }
        }

        return $this;
    }
}
