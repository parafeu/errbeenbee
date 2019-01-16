<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class OwnerInterfaceController extends AbstractController
{
    /**
     * @Route("/owner/interface", name="owner_interface")
     */
    public function index()
    {
        return $this->render('owner_interface/index.html.twig', [
            'controller_name' => 'OwnerInterfaceController',
        ]);
    }
}
