<?php

namespace App\Controller;

use App\Application\Sonata\MediaBundle\Entity\Media;
use App\Application\Sonata\MediaBundle\PHPCR\MediaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PublicController extends AbstractController
{
    /**
     * @Route("/", name="public")
     */
    public function index()
    {

        $mediaRepo = $this->getDoctrine()->getRepository(Media::class);
        $media = $mediaRepo->find(1);
        return $this->render('public/index.html.twig', [
            'controller_name' => 'PublicController',
            'media' => $media
        ]);
    }
}
