<?php

namespace DoCarmo\AppBundle\Controller;

use DoCarmo\AppBundle\Entity\GroupRole;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Grouprole controller.
 *
 */
class GroupRoleController extends Controller
{
    /**
     * Lists all groupRole entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $groupRoles = $em->getRepository('DoCarmoAppBundle:GroupRole')->findAll();

        return $this->render('grouprole/index.html.twig', array(
            'groupRoles' => $groupRoles,
        ));
    }

    /**
     * Creates a new groupRole entity.
     *
     */
    public function newAction(Request $request)
    {
        $groupRole = new Grouprole();
        $form = $this->createForm('DoCarmo\AppBundle\Form\GroupRoleType', $groupRole);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($groupRole);
            $em->flush();

            return $this->redirectToRoute('group-role_show', array('id' => $groupRole->getId()));
        }

        return $this->render('grouprole/new.html.twig', array(
            'groupRole' => $groupRole,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a groupRole entity.
     *
     */
    public function showAction(GroupRole $groupRole)
    {
        $deleteForm = $this->createDeleteForm($groupRole);

        return $this->render('grouprole/show.html.twig', array(
            'groupRole' => $groupRole,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing groupRole entity.
     *
     */
    public function editAction(Request $request, GroupRole $groupRole)
    {
        $deleteForm = $this->createDeleteForm($groupRole);
        $editForm = $this->createForm('DoCarmo\AppBundle\Form\GroupRoleType', $groupRole);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('group-role_edit', array('id' => $groupRole->getId()));
        }

        return $this->render('grouprole/edit.html.twig', array(
            'groupRole' => $groupRole,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a groupRole entity.
     *
     */
    public function deleteAction(Request $request, GroupRole $groupRole)
    {
        $form = $this->createDeleteForm($groupRole);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($groupRole);
            $em->flush();
        }

        return $this->redirectToRoute('group-role_index');
    }

    /**
     * Creates a form to delete a groupRole entity.
     *
     * @param GroupRole $groupRole The groupRole entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(GroupRole $groupRole)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('group-role_delete', array('id' => $groupRole->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
