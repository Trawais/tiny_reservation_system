<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Visitor
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="datetime")
     */
    private $enrolledAt;

    /**
     * @ORM\ManyToOne(targetEntity="ReservationSlot", inversedBy="visitors")
     * @ORM\JoinColumn(name="reservation_slot_id", referencedColumnName="id")
     */
    private $reservationSlot;

    

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
     * Set name
     *
     * @param string $name
     *
     * @return Visitor
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
     * Set enrolledAt
     *
     * @param \DateTime $enrolledAt
     *
     * @return Visitor
     */
    public function setEnrolledAt($enrolledAt)
    {
        $this->enrolledAt = $enrolledAt;

        return $this;
    }

    /**
     * Get enrolledAt
     *
     * @return \DateTime
     */
    public function getEnrolledAt()
    {
        return $this->enrolledAt;
    }

    /**
     * Set reservationSlot
     *
     * @param \AppBundle\Entity\ReservationSlot $reservationSlot
     *
     * @return Visitor
     */
    public function setReservationSlot(\AppBundle\Entity\ReservationSlot $reservationSlot = null)
    {
        $this->reservationSlot = $reservationSlot;

        return $this;
    }

    /**
     * Get reservationSlot
     *
     * @return \AppBundle\Entity\ReservationSlot
     */
    public function getReservationSlot()
    {
        return $this->reservationSlot;
    }
}
