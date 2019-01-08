<?php

namespace App\Controller;

use App\Entity\ReservationSlot;
use App\Entity\Visitor;
use App\Form\VisitorType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class VisitorController extends AbstractController
{
    /**
     * @Route("/{reservationSlotId}/visitor/create", name="app_addVisitor")
     * @IsGranted("ROLE_USER")
     *
     * @param Request $request
     * @param $reservationSlotId
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \Exception
     */
    public function create(Request $request, $reservationSlotId)
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

        return $this->redirectToRoute('app_showAllReservations');
    }

    /**
     * @Route("/visitor/{id}/delete", name="app_deleteVisitor")
     * @IsGranted("ROLE_ADMIN")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function delete($id)
    {
        $em = $this->getDoctrine()->getManager();
        $visitor = $em->getRepository(Visitor::class)->find($id);

        if (!$visitor) {
            throw $this->createNotFoundException(
                'No "visitor" found for id '.$id
            );
        }

        $em->remove($visitor);
        $em->flush();

        return $this->redirectToRoute('app_showAllReservations');
    }

    /**
     * @param $reservationSlotId
     * @return ReservationSlot|null
     */
    private function getReservationSlot($reservationSlotId)
    {
        $em = $this->getDoctrine()->getManager();
        $reservationSlot = $em->getRepository(ReservationSlot::class)->find($reservationSlotId);

        if (!$reservationSlot) {
            throw $this->createNotFoundException(
                'No "reservation slot" found for id '.$reservationSlotId
            );
        }

        return $reservationSlot;
    }
}