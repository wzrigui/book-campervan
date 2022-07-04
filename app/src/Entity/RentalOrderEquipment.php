<?php

namespace App\Entity;

use App\Repository\RentalOrderEquipmentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RentalOrderEquipmentRepository::class)]
class RentalOrderEquipment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $quantity;

    #[ORM\ManyToOne(targetEntity: RentalOrder::class, inversedBy: 'equipments')]
    #[ORM\JoinColumn(nullable: false)]
    private $rentalOrders;

    #[ORM\ManyToOne(targetEntity: Equipment::class, inversedBy: 'rentalOrders')]
    #[ORM\JoinColumn(nullable: false)]
    private $equipments;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getRentalOrders(): ?RentalOrder
    {
        return $this->rentalOrders;
    }

    public function setRentalOrders(?RentalOrder $rentalOrders): self
    {
        $this->rentalOrders = $rentalOrders;

        return $this;
    }

    public function getEquipments(): ?Equipment
    {
        return $this->equipments;
    }

    public function setEquipments(?Equipment $equipments): self
    {
        $this->equipments = $equipments;

        return $this;
    }
}
