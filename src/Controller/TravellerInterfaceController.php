<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TravellerInterfaceController extends AbstractController
{
    /**
     * @Route("/traveller/interface", name="traveller_interface")
     */
    public function index()
    {
        return $this->render('traveller_interface/index.html.twig', [
            'controller_name' => 'TravellerInterfaceController',
        ]);
    }
}
