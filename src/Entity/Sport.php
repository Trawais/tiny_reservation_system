<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Sport
 *
 * @ORM\Table(name="sport")
 * @ORM\Entity(repositoryClass="App\Repository\SportRepository")
 */
class Sport
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, unique=true)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ReservationSlot", mappedBy="sport")
     */
    private $reservationSlots;

    public function __construct()
    {
        $this->reservationSlots = new ArrayCollection();
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Sport
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return Collection|ReservationSlot[]
     */
    public function getReservationSlots(): Collection
    {
        return $this->reservationSlots;
    }

    public function addReservationSlot(ReservationSlot $reservationSlot): self
    {
        if (!$this->reservationSlots->contains($reservationSlot)) {
            $this->reservationSlots[] = $reservationSlot;
            $reservationSlot->setSport($this);
        }

        return $this;
    }

    public function removeReservationSlot(ReservationSlot $reservationSlot): self
    {
        if ($this->reservationSlots->contains($reservationSlot)) {
            $this->reservationSlots->removeElement($reservationSlot);
            // set the owning side to null (unless already changed)
            if ($reservationSlot->getSport() === $this) {
                $reservationSlot->setSport(null);
            }
        }

        return $this;
    }
}

