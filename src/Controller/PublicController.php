<?php

namespace App\Controller;

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
        return $this->render('public/index.html.twig', [
            'controller_name' => 'PublicController',
            'houses' => $houseRepository->findAll(),
            'rooms' => $roomRepository->findAll()
        ]);
    }
}
