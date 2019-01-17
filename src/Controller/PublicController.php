<?php

namespace App\Controller;

use App\Application\Sonata\MediaBundle\Entity\Media;
use App\Application\Sonata\MediaBundle\PHPCR\MediaRepository;
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
        $media = $mediaRepo->find(1);
        return $this->render('public/index.html.twig', [
            'controller_name' => 'PublicController',
            'houses' => $houseRepository->findAll(),
            'rooms' => $roomRepository->findAll(),
            'media' => $media
        ]);
    }
}
