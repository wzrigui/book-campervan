<?php

namespace App\Entity;

use App\Repository\StationCamperRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StationCamperRepository::class)]
#[ORM\HasLifecycleCallbacks]
class StationCamper
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    /**
     * @ORM\Column(type="boolean", name="available",options:{"default": 1})
     */
    private $available;

    #[ORM\ManyToOne(targetEntity: Station::class, inversedBy: 'stationCampers')]
    #[ORM\JoinColumn(nullable: false)]
    private $station;

    #[ORM\ManyToOne(targetEntity: Campervan::class, inversedBy: 'stationCamper')]
    #[ORM\JoinColumn(nullable: false)]
    private $campervan;

    #[ORM\Column(type: 'datetime')]
    private $createdAt;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $updatedAt;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isAvailable(): ?bool
    {
        return $this->available;
    }

    public function setAvailable(bool $available): self
    {
        $this->available = $available;

        return $this;
    }

    public function getStation(): ?Station
    {
        return $this->station;
    }

    public function setStation(?Station $station): self
    {
        $this->station = $station;

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
    
    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt() :?\DateTimeInterface
    {
        return $this->updatedAt;
    }
    
    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

   #[ORM\PreUpdate]
   public function onPreUpdate()
   {
       $this->updatedAt = new \DateTime();
   }
}
