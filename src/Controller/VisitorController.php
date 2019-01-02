<?php

namespace App\Controller;

use App\Entity\ReservationSlot;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Visitor;
use Symfony\Component\HttpFoundation\Request;
use App\Form\VisitorType;

class VisitorController extends Controller
{
    public function createAction(Request $request, $reservationSlotId)
    {
        $visitor = new Visitor();
        $visitor->setReservationSlot($this->getReservationSlot($reservationSlotId));

        $form = $this->createForm(VisitorType::class, $visitor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $visitor->setEnrolledAt(new \DateTime());
            $em = $this->getDoctrine()->getManager();
            $em->persist($visitor);
            $em->flush();
        }

        return $this->redirectToRoute('show_all_reservation_slot');
    }

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $visitor = $em->getRepository('AppBundle:Visitor')->find($id);

        if (!$visitor) {
            throw $this->createNotFoundException(
                'No "visitor" found for id '.$id
            );
        }

        $em->remove($visitor);
        $em->flush();

        return $this->redirectToRoute('show_all_reservation_slot');
    }

    /**
     * @param $reservationSlotId
     * @return ReservationSlot|null
     */
    private function getReservationSlot($reservationSlotId)
    {
        $em = $this->getDoctrine()->getManager();
        $reservationSlot = $em->getRepository('AppBundle:ReservationSlot')->find($reservationSlotId);

        if (!$reservationSlot) {
            throw $this->createNotFoundException(
                'No "reservation slot" found for id '.$reservationSlotId
            );
        }

        return $reservationSlot;
    }
}