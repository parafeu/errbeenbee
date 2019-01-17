<?php

namespace App\Controller;

use App\Entity\Traveller;
use App\Form\TravellerType;
use App\Repository\TravellerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/traveller")
 */
class TravellerController extends AbstractController
{
    /**
     * @Route("/", name="traveller_index", methods={"GET"})
     */
    public function index(TravellerRepository $travellerRepository): Response
    {
        return $this->render('traveller/index.html.twig', [
            'travellers' => $travellerRepository->findAll(),
        ]);
    }

    /**
     * @Route("/signup", name="traveller_new", methods={"GET","POST"})
     */
    public function new(Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        $traveller = new Traveller();
        $form = $this->createForm(TravellerType::class, $traveller);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($traveller);
            $entityManager->flush();

            return $this->redirectToRoute('traveller_index');
        }

        return $this->render('traveller/signup.html.twig', [
            'traveller' => $traveller,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="traveller_show", methods={"GET"})
     */
    public function show(Traveller $traveller): Response
    {
        return $this->render('traveller/show.html.twig', [
            'traveller' => $traveller,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="traveller_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Traveller $traveller): Response
    {
        $form = $this->createForm(TravellerType::class, $traveller);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('traveller_index', [
                'id' => $traveller->getId(),
            ]);
        }

        return $this->render('traveller/edit.html.twig', [
            'traveller' => $traveller,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="traveller_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Traveller $traveller): Response
    {
        if ($this->isCsrfTokenValid('delete'.$traveller->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($traveller);
            $entityManager->flush();
        }

        return $this->redirectToRoute('traveller_index');
    }
}
