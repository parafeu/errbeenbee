<?php

namespace App\Controller;

use App\Application\Sonata\MediaBundle\Entity\Media;
use App\Entity\Node\NodeHouse;
use App\Entity\Node\NodeVisitor;
use App\Entity\Owner;
use App\Form\LoginType;
use GraphAware\Neo4j\OGM\EntityManagerInterface;
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
    public function index(HouseRepository $houseRepository, RoomRepository $roomRepository, EntityManagerInterface $em)
    {

        $sessionId = $this->get("session")->get("visitorId");

        $vis = $em->getRepository(NodeVisitor::class)->findOneBy(['sessionId' => $sessionId]);

        if(!$vis){
            $vis = new NodeVisitor($sessionId);
            $em->persist($vis);
            $em->flush();
        }

        $mediaRepo = $this->getDoctrine()->getRepository(Media::class);
        $media = $mediaRepo->find(3);

        $houses = $houseRepository->findAll();
        $housesNodes = $em->getRepository(NodeHouse::class)->findAll();
        for($i = 0; $i < count($houses); $i++){
            foreach ($housesNodes as $node){
                if($houses[$i]->getId() == $node->getHouseId()){
                    $houses[$i]->setNbVisites($node->getNbVisites());
                }
            }
        }
        return $this->render('public/index.html.twig', [
            'controller_name' => 'PublicController',
            'houses' => $houses,
            'rooms' => $roomRepository->findAll(),
            'defaultImage' => $media
        ]);
    }

    /**
     * @Route("/login", name="public_login", methods={"GET","POST"})
     */
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
