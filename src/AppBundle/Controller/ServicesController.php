<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\City;
use AppBundle\Entity\Travel;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;

class ServicesController extends Controller
{
    /**
     * @Route("/save/city", name="saveCitites")
     */
    public function saveCitiesAction(Request $request)
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to your action: createAction(EntityManagerInterface $em)
        $em = $this->getDoctrine()->getManager();

        $city = new City();
        $city->setName('NYC');

        // tells Doctrine you want to (eventually) save the Product (no queries yet)
        $em->persist($city);

        // actually executes the queries (i.e. the INSERT query)
        $em->flush();

        return new Response('Saved new city with id '.$city->getId());
    }

    /**
     * @Route("/save/travel", name="saveTravel")
     */
    public function saveTravelAction(Request $request)
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to your action: createAction(EntityManagerInterface $em)
        $em = $this->getDoctrine()->getManager();

        $travel = new Travel();
        $travel->setCity1($this->showInfo(City::class, 1));
        $travel->setCity2(3);
        $travel->setCost(5);

        // tells Doctrine you want to (eventually) save the Product (no queries yet)
        $em->persist($travel);

        // actually executes the queries (i.e. the INSERT query)
        $em->flush();

        return new Response('Saved new travel with id '.$travel->getId());
    }

    /**
     * @Route(
     *      "/show/{slug}/{id}",
     *      name="show", 
     *      requirements={
     *          "slug":"city|travel"
     *      }
     * )
     */
    public function showAction(Request $request, $slug, $id)
    {
        if ($slug == "city") {
            $item = $this->showInfo(City::class, $id);
        } else if ($slug == "travel") {
            $item = $this->showInfo(Travel::class, $id);
        }

        if (!$item) {
            throw $this->createNotFoundException(
                'No ' . $slug . ' found for id ' . $id
            );
        }

        return new Response("Item found " . $item->getName());
    }

    private function showInfo($entity, $id)
    {
        return $this->getDoctrine()->getRepository($entity)->find($id);
    }
}