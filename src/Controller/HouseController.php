<?php
namespace App\Controller;

use App\Entity\House;
use App\Entity\Node\NodeConsult;
use App\Entity\Node\NodeEquipement;
use App\Entity\Node\NodeHouse;
use App\Entity\Node\NodeVisitor;
use App\Form\HouseType;
use App\Repository\HouseRepository;
use GraphAware\Neo4j\OGM\EntityManagerInterface;
use GraphAware\Neo4j\OGM\Proxy\LazyCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Node\Node;

/**
 * @Route("/house")
 */
class HouseController extends AbstractController
{
    /**
     * @Route("/", name="house_index", methods={"GET"})
     */
    public function index(HouseRepository $houseRepository, EntityManagerInterface $em): Response
    {
        $houses = $houseRepository->findAll();
        $housesNodes = $em->getRepository(NodeHouse::class)->findAll();
        for($i = 0; $i < count($houses); $i++){
            foreach ($housesNodes as $node){
                if($houses[$i]->getId() == $node->getHouseId()){
                    $houses[$i]->setNbVisites($node->getNbVisites());
                }
            }
        }

        return $this->render('house/index.html.twig', [
            'houses' => $houses
        ]);
    }

    /**
     * @Route("/new", name="house_new", methods={"GET","POST"})
     */
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $house = new House();
        $form = $this->createForm(HouseType::class, $house);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($house);
            $entityManager->flush();

            $nodeHouse = new NodeHouse($house->getId(), $house->getName());

            if($house->getEquipments() !== null){
                foreach ($house->getEquipments() as $equipement){
                    $nodeEquipement = $em->getRepository(NodeEquipement::class)->findOneBy(["equipementId" => $equipement->getId()]);
                    $nodeHouse->getEquipements()->add($nodeEquipement);
                }
            }
            $em->persist($nodeHouse);
            $em->flush();

            return $this->redirectToRoute('house_index');
        }

        return $this->render('house/new.html.twig', [
            'house' => $house,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="house_show", methods={"GET"})
     */
    public function show(House $house, EntityManagerInterface $emg): Response
    {
        $sessionId = $this->get("session")->get("visitorId");
        $visitor = $emg->getRepository(NodeVisitor::class)->findOneBy(['sessionId' => $sessionId]);

        if(!$visitor){
            $visitor = new NodeVisitor($sessionId);
            $emg->persist($visitor);
            $emg->flush();
        }
        /** @var NodeHouse $nodeHouse */
        $nodeHouse = $emg->getRepository(NodeHouse::class)->findOneBy(["houseId" => $house->getId()]);

        /** @var LazyCollection $consults */
        $consults = $nodeHouse->getConsults();

        /** @var NodeConsult $consult */
        $consult = null;

        dump($nodeHouse);
        dump($visitor);


        if(count($consults) > 0){
            foreach($consults as $c){
                if($c->getVisitor()->getSessionId() == $visitor->getSessionId()){
                    $consult = $c;
                }
            }
        }

        if(!$consult){
            $consult = new NodeConsult($visitor, $nodeHouse);
            $consult->incrementNbVisites();
            $nodeHouse->getConsults()->add($consult);
            $visitor->getConsults()->add($consult);
            $emg->persist($nodeHouse);
            $emg->persist($visitor);
        }else{
            $consult->incrementNbVisites();
            dump($consult);
        }

        $emg->persist($consult);

        $emg->flush();

       /* if(!$consult){
            $consult = new NodeConsult($visitor, $house);
        }
        $consult->incrementNbVisites();
        $emg->persist($consult);
        $emg->flush();*/

        return $this->render('house/show.html.twig', [
            'house' => $house,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="house_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, House $house): Response
    {
        $form = $this->createForm(HouseType::class, $house);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('house_index', [
                'id' => $house->getId(),
            ]);
        }

        return $this->render('house/edit.html.twig', [
            'house' => $house,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="house_delete", methods={"DELETE"})
     */
    public function delete(Request $request, House $house): Response
    {
        if ($this->isCsrfTokenValid('delete'.$house->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($house);
            $entityManager->flush();
        }

        return $this->redirectToRoute('house_index');
    }
}
