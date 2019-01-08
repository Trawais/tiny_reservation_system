<?php

namespace App\Controller;

use App\Entity\ReservationSlot;
use App\Entity\Visitor;
use App\Form\ReservationSlotType;
use App\Form\VisitorType;
use App\Repository\ReservationSlotRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ReservationSlotController extends AbstractController
{
    /**
     * @Route("/create", name="app_createReservationSlot")
     * @IsGranted("ROLE_ADMIN")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function createAction(Request $request)
    {
        // Delete all old reservation slots
        // This is HACK
        // So we don't need any cron job for cleaning old slots
        $this->deleteAllOld();

        $reservation_slot = new ReservationSlot();
        $reservation_slot->setDate(new \DateTime());
        $reservation_slot->setCapacity(8);

        $form = $this->createForm(ReservationSlotType::class, $reservation_slot);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($reservation_slot);
            $em->flush();

            return $this->redirectToRoute('app_showAllReservations');
        }

        return $this->render('reservation_slot/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}/update", name="app_updateReservationSlot")
     * @IsGranted("ROLE_ADMIN")
     *
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $reservation_slot = $em->getRepository(ReservationSlot::class)->find($id);

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

    /**
     * @Route("/{id}/delete", name="app_deleteReservationSlot")
     * @IsGranted("ROLE_ADMIN")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $reservation_slot = $em->getRepository(ReservationSlot::class)->find($id);

        if (!$reservation_slot) {
            throw $this->createNotFoundException(
                'No "reservation slot" found for id '.$id
            );
        }

        $em->remove($reservation_slot);
        $em->flush();

        return $this->redirectToRoute('show_all_reservation_slot');
    }

    /**
     * @throws \Exception
     */
    private function deleteAllOld()
    {

        $em = $this->getDoctrine()->getManager();
        /** @var ReservationSlotRepository $repository */
        $repository = $em->getRepository('App:ReservationSlot');

        $oldSlots = $repository->createQueryBuilder('rs')
            ->where('rs.date < :today')
            ->setParameter('today', new \DateTime('-12 hours'))
            ->getQuery()
            ->getResult();

        foreach ($oldSlots as $oldSlot) {
            $em->remove($oldSlot);
        }

        $em->flush();
    }

    /**
     * @Route("/", name="app_showAllReservations")
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function showAll()
    {
        /** @var ReservationSlotRepository $repository */
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository("App:ReservationSlot");

        $reservations =  $repository->createQueryBuilder('r')
            ->where('r.date > :today')
            ->setParameter('today', new \DateTime('-12 hours'))
            ->orderBy('r.date', 'ASC')
            ->getQuery()
            ->getResult();

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

        // $reservationsForms is always array; empty in the worst case
//        return $this->render('AppBundle:reservation_slot:showAll.html.twig', [
        return $this->render("reservation_slot/showAll.html.twig", [
            'reservationsForms' => $reservationsForms
        ]);
    }
}
