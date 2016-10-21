<?php
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */
class ReservationSlot
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank()
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $location;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $lector;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $level;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     * @Assert\Range(min = 0, max = 255)
     */
    private $capacity;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $note;

    /**
     * @ORM\OneToMany(targetEntity="Visitor", mappedBy="reservationSlot")
     */
    private $visitors;



    public function __construct()
    {
        $this->visitors = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return ReservationSlot
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set location
     *
     * @param string $location
     *
     * @return ReservationSlot
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set lector
     *
     * @param string $lector
     *
     * @return ReservationSlot
     */
    public function setLector($lector)
    {
        $this->lector = $lector;

        return $this;
    }

    /**
     * Get lector
     *
     * @return string
     */
    public function getLector()
    {
        return $this->lector;
    }

    /**
     * Set level
     *
     * @param string $level
     *
     * @return ReservationSlot
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return string
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set capacity
     *
     * @param integer $capacity
     *
     * @return ReservationSlot
     */
    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;

        return $this;
    }

    /**
     * Get capacity
     *
     * @return integer
     */
    public function getCapacity()
    {
        return $this->capacity;
    }

    /**
     * Set note
     *
     * @param string $note
     *
     * @return ReservationSlot
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Add visitor
     *
     * @param \AppBundle\Entity\Visitor $visitor
     *
     * @return ReservationSlot
     */
    public function addVisitor(\AppBundle\Entity\Visitor $visitor)
    {
        $this->visitors[] = $visitor;

        return $this;
    }

    /**
     * Remove visitor
     *
     * @param \AppBundle\Entity\Visitor $visitor
     */
    public function removeVisitor(\AppBundle\Entity\Visitor $visitor)
    {
        $this->visitors->removeElement($visitor);
    }

    /**
     * Get visitors
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVisitors()
    {
        return $this->visitors;
    }
}
