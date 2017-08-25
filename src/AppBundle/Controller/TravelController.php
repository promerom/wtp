<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Travel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Travel controller.
 *
 * @Route("travel")
 */
class TravelController extends Controller
{
    /**
     * Lists all travel entities.
     *
     * @Route("/", name="travel_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $travels = $em->getRepository('AppBundle:Travel')->findAll();

        return $this->render('travel/index.html.twig', array(
            'travels' => $travels,
        ));
    }

    /**
     * Creates a new travel entity.
     *
     * @Route("/new", name="travel_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $travel = new Travel();
        $form = $this->createForm('AppBundle\Form\TravelType', $travel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($travel);
            $em->flush();

            // return $this->redirectToRoute('travel_show', array('id' => $travel->getId()));
            return $this->json(array("response" => "travel was saved successfully"));
        } else if ($form->isSubmitted() && !$form->isValid()) {
            return $this->json(array((string)$form->getErrors(true)));
        }

        return $this->render('travel/new.html.twig', array(
            'travel' => $travel,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a travel entity.
     *
     * @Route("/{id}", name="travel_show")
     * @Method("GET")
     */
    public function showAction(Travel $travel)
    {
        $deleteForm = $this->createDeleteForm($travel);

        return $this->render('travel/show.html.twig', array(
            'travel' => $travel,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing travel entity.
     *
     * @Route("/{id}/edit", name="travel_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Travel $travel)
    {
        $deleteForm = $this->createDeleteForm($travel);
        $editForm = $this->createForm('AppBundle\Form\TravelType', $travel);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('travel_edit', array('id' => $travel->getId()));
        }

        return $this->render('travel/edit.html.twig', array(
            'travel' => $travel,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a travel entity.
     *
     * @Route("/{id}", name="travel_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Travel $travel)
    {
        $form = $this->createDeleteForm($travel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($travel);
            $em->flush();
        }

        return $this->redirectToRoute('travel_index');
    }

    /**
     * Creates a form to delete a travel entity.
     *
     * @param Travel $travel The travel entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Travel $travel)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('travel_delete', array('id' => $travel->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
