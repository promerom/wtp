<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\City;
use AppBundle\Entity\Travel;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;

use AppBundle\Model\WorldTravellerProblem;

class ServicesController extends Controller
{
    /**
     * @Route("/calculate", name="calculate")
     */
    public function calculateAction(Request $request)
    {
        $travels = $this->getDoctrine()->getRepository(Travel::class)->findAll();
        $cities = $this->getDoctrine()->getRepository(City::class)->findAll();

        foreach ($cities as $key => $value) {
            $citiesArray[] = $value->getName();
        }

        $points = array();

        foreach ($travels as $key => $value) {
            $city1 = $value->getCity1()->getName();
            $city2 = $value->getCity2()->getName();
            $cost = $value->getCost();

            $info1 = array($cost, $city1, $city2);
            $info2 = array($cost, $city2, $city1);

            array_push($points, $info1, $info2);
        }

        $wtp = new WorldTravellerProblem($points);
        $path = $wtp->wtp();

        $cost = $path["cost"];
        
        return $this->render('services/calculate.html.twig', array(
            'path' => $path["road"],
            'cost' => $cost
        ));

        //return new Response("List of cities that denotes the user itinerary " . json_encode($path) . " </br> Total cost of the trip would be " . $cost);
    }
}