<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\ReservationSlot;

class ReservationSlotController extends Controller
{
    public function createAction(Request $request)
    {
        $reservation_slot = new ReservationSlot();
        $reservation_slot->setLocation('v hale');
        $reservation_slot->setDate(new \DateTime());
        $reservation_slot->setCapacity(8);

        $em = $this->getDoctrine()->getManager();
        $em->persist($reservation_slot);
        $em->flush();

        return $this->render('reservation_slot/created.html.twig', [
            'reservation_slot' => $reservation_slot
        ]);
    }
}
