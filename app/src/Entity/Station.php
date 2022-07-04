<?php

namespace App\Entity;

use App\Repository\StationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StationRepository::class)]
class Station
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\OneToMany(mappedBy: 'station', targetEntity: StationEquipment::class, fetch:"LAZY")]
    private $stationEquipments;

    #[ORM\OneToMany(mappedBy: 'station', targetEntity: StationCamper::class, fetch:"LAZY")]
    private $stationCampers;

    public function __construct()
    {
        $this->stationEquipments = new ArrayCollection();
        $this->stationCampers = new ArrayCollection();
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
     * @return Collection<int, StationEquipment>
     */
    public function getStationEquipments(): Collection
    {
        return $this->stationEquipments;
    }

    public function addStationEquipment(StationEquipment $stationEquipment): self
    {
        if (!$this->stationEquipments->contains($stationEquipment)) {
            $this->stationEquipments[] = $stationEquipment;
            $stationEquipment->setStation($this);
        }

        return $this;
    }

    public function removeStationEquipment(StationEquipment $stationEquipment): self
    {
        if ($this->stationEquipments->removeElement($stationEquipment)) {
            // set the owning side to null (unless already changed)
            if ($stationEquipment->getStation() === $this) {
                $stationEquipment->setStation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, StationCamper>
     */
    public function getStationCampers(): Collection
    {
        return $this->stationCampers;
    }

    public function addStationCamper(StationCamper $stationCamper): self
    {
        if (!$this->stationCampers->contains($stationCamper)) {
            $this->stationCampers[] = $stationCamper;
            $stationCamper->setStation($this);
        }

        return $this;
    }

    public function removeStationCamper(StationCamper $stationCamper): self
    {
        if ($this->stationCampers->removeElement($stationCamper)) {
            // set the owning side to null (unless already changed)
            if ($stationCamper->getStation() === $this) {
                $stationCamper->setStation(null);
            }
        }

        return $this;
    }
}
