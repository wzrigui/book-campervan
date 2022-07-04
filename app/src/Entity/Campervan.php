<?php

namespace App\Entity;

use App\Repository\CampervanRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CampervanRepository::class)]
class Campervan
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'text', nullable: true)]
    private $description;

    #[ORM\OneToMany(mappedBy: 'campervan', targetEntity: StationCamper::class)]
    private $stationCamper;

    #[ORM\OneToMany(mappedBy: 'campervan', targetEntity: RentalOrder::class)]
    private $rentalOrder;

    public function __construct()
    {
        $this->stationCamper = new ArrayCollection();
        $this->rentalOrder = new ArrayCollection();
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
     * @return Collection<int, StationCamper>
     */
    public function getStationCamper(): Collection
    {
        return $this->stationCamper;
    }

    public function addStationCamper(StationCamper $stationCamper): self
    {
        if (!$this->stationCamper->contains($stationCamper)) {
            $this->stationCamper[] = $stationCamper;
            $stationCamper->setCampervan($this);
        }

        return $this;
    }

    public function removeStationCamper(StationCamper $stationCamper): self
    {
        if ($this->stationCamper->removeElement($stationCamper)) {
            // set the owning side to null (unless already changed)
            if ($stationCamper->getCampervan() === $this) {
                $stationCamper->setCampervan(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, RentalOrder>
     */
    public function getRentalOrder(): Collection
    {
        return $this->rentalOrder;
    }

    public function addRentalOrder(RentalOrder $rentalOrder): self
    {
        if (!$this->rentalOrder->contains($rentalOrder)) {
            $this->rentalOrder[] = $rentalOrder;
            $rentalOrder->setCampervan($this);
        }

        return $this;
    }

    public function removeRentalOrder(RentalOrder $rentalOrder): self
    {
        if ($this->rentalOrder->removeElement($rentalOrder)) {
            // set the owning side to null (unless already changed)
            if ($rentalOrder->getCampervan() === $this) {
                $rentalOrder->setCampervan(null);
            }
        }

        return $this;
    }
}
