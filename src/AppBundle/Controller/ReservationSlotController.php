<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\ReservationSlot;
use AppBundle\Form\ReservationSlotType;
use AppBundle\Entity\Visitor;
use AppBundle\Form\VisitorType;

class ReservationSlotController extends Controller
{
    public function createAction(Request $request)
    {
        $reservation_slot = new ReservationSlot();
        $reservation_slot->setDate(new \DateTime());
        $reservation_slot->setCapacity(8);

        $form = $this->createForm(ReservationSlotType::class, $reservation_slot);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($reservation_slot);
            $em->flush();

            return $this->redirectToRoute('show_all_reservation_slot');
        }

        return $this->render('reservation_slot/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $reservation_slot = $em->getRepository('AppBundle:ReservationSlot')->find($id);

        if (!$reservation_slot) {
            throw $this->createNotFoundException(
                'No "reservation slot" found for id '.$id
            );
        }

        $form = $this->createForm(ReservationSlotType::class, $reservation_slot);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('show_all_reservation_slot');
        }

        return $this->render('reservation_slot/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $reservation_slot = $em->getRepository('AppBundle:ReservationSlot')->find($id);

        if (!$reservation_slot) {
            throw $this->createNotFoundException(
                'No "reservation slot" found for id '.$id
            );
        }

        $em->remove($reservation_slot);
        $em->flush();

        return $this->redirectToRoute('show_all_reservation_slot');
    }

    public function showAllAction()
    {
        $query = $this->getDoctrine()
            ->getRepository('AppBundle:ReservationSlot')
            ->createQueryBuilder('r')
            ->where('r.date > :today')
            ->setParameter('today', new \DateTime('-12 hours'))
            ->orderBy('r.date', 'ASC')
            ->getQuery()
        ;
        $reservations = $query->getResult();

        $reservationsForms = [];
        foreach ($reservations as $reservation) {
            $visitor = new Visitor();
            $visitor->setReservationSlot($reservation);
            $form = $this->createForm(VisitorType::class, $visitor);
            $reservationsForms[] = [
                'reservation' => $reservation,
                'form' => $form->createView()
            ];
        }

        // $reservationsForms is always array, empty in the worst case
        return $this->render('reservation_slot/showAll.html.twig', [
            'reservationsForms' => $reservationsForms
        ]);
    }
}
