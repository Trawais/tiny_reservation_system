<?php

namespace App\Controller;

use App\Entity\Sport;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SportController extends AbstractController
{
    /**
     * @Route("/sport", name="app_showAllSports")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAllAction()
    {
        $sports = $this->getDoctrine()
            ->getManager()
            ->getRepository(Sport::class)
            ->findAll();

        return $this->render(
            "Sport/show_all.html.twig",
            [ "sports" => $sports]
        );
    }

    /**
     * @Route("/sport/create", name="app_createSport")
     * @IsGranted("ROLE_ADMIN")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create()
    {
        return $this->render("Sport/create.html.twig", array(
            // ...
        ));
    }

    /**
     * @Route("/sport/{id}/delete", name="app_deleteSport")
     * @IsGranted("ROLE_ADMIN")
     *
     * @param int id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function delete(int $id)
    {
        $em = $this->getDoctrine()->getManager();
        $sport = $em->getRepository(Sport::class)->find($id);

        if (empty($sport)) {
            throw $this->createNotFoundException(
                "No sport has been found for id: '$id'"
            );
        }

        // TODO: Delete only if sport is not used anywhere
        $em->remove($sport);
        $em->flush();

        return $this->redirectToRoute("app_showAllSports");
    }
}
