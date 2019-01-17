<?php

namespace App\Controller;

use App\Entity\Room;
use Buzz\Message\Response;
use Doctrine\ORM\EntityNotFoundException;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\JsonResponse;

class RoomsController extends AbstractFOSRestController
{
    public function getRoomsAction()
    {
        $roomRepo = $this->getDoctrine()->getRepository(Room::class);

        $rooms = $roomRepo->findAll();

        $view = View::create($rooms);
        $view->setFormat('json');

        return $view;
    } // "get_rooms"            [GET] /rooms

    public function getRoomAction($id)
    {
        $roomRepo = $this->getDoctrine()->getRepository(Room::class);

        $room = $roomRepo->find($id);

        if (!$room) {
            return new JsonResponse(['error' => 'Room with id ' . $id . ' does not exist!'], Response::HTTP_NOT_FOUND);
        }

        $view = View::create($room);
        $view->setFormat('json');

        return $view;
    } // "get_room"             [GET] /rooms/{id}
}