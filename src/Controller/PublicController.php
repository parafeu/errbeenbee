<?php

namespace App\Controller;

use App\Application\Sonata\MediaBundle\Entity\Media;
use App\Entity\Owner;
use App\Form\LoginType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\HouseRepository;
use App\Repository\RoomRepository;


class PublicController extends AbstractController
{
    /**
     * @Route("/", name="public")
     */
    public function index(HouseRepository $houseRepository, RoomRepository $roomRepository)
    {
        $mediaRepo = $this->getDoctrine()->getRepository(Media::class);
        $media = $mediaRepo->find(3);
        return $this->render('public/index.html.twig', [
            'controller_name' => 'PublicController',
            'houses' => $houseRepository->findAll(),
            'rooms' => $roomRepository->findAll(),
            'defaultImage' => $media
        ]);
    }


    public function login(Request $request): Response
    {
        $owner = new Owner();
        $form = $this->createForm(LoginType::class, $owner);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            return $this->redirectToRoute('public');
        }

        return $this->render('public/auth.html.twig', [
            'owner' => $owner,
            'form' => $form->createView(),
        ]);
    }
}
