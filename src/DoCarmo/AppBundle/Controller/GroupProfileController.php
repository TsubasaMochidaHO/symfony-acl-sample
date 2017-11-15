<?php

namespace DoCarmo\AppBundle\Controller;

use DoCarmo\AppBundle\Entity\GroupProfile;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Groupprofile controller.
 *
 */
class GroupProfileController extends Controller
{
    /**
     * Lists all groupProfile entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $groupProfiles = $em->getRepository('DoCarmoAppBundle:GroupProfile')->findAll();

        return $this->render('groupprofile/index.html.twig', array(
            'groupProfiles' => $groupProfiles,
        ));
    }

    /**
     * Creates a new groupProfile entity.
     *
     */
    public function newAction(Request $request)
    {
        $groupProfile = new Groupprofile();
        $form = $this->createForm('DoCarmo\AppBundle\Form\GroupProfileType', $groupProfile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($groupProfile);
            $em->flush();

            return $this->redirectToRoute('group-profile_show', array('id' => $groupProfile->getId()));
        }

        return $this->render('groupprofile/new.html.twig', array(
            'groupProfile' => $groupProfile,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a groupProfile entity.
     *
     */
    public function showAction(GroupProfile $groupProfile)
    {
        $deleteForm = $this->createDeleteForm($groupProfile);

        return $this->render('groupprofile/show.html.twig', array(
            'groupProfile' => $groupProfile,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing groupProfile entity.
     *
     */
    public function editAction(Request $request, GroupProfile $groupProfile)
    {
        $deleteForm = $this->createDeleteForm($groupProfile);
        $editForm = $this->createForm('DoCarmo\AppBundle\Form\GroupProfileType', $groupProfile);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('group-profile_edit', array('id' => $groupProfile->getId()));
        }

        return $this->render('groupprofile/edit.html.twig', array(
            'groupProfile' => $groupProfile,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a groupProfile entity.
     *
     */
    public function deleteAction(Request $request, GroupProfile $groupProfile)
    {
        $form = $this->createDeleteForm($groupProfile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($groupProfile);
            $em->flush();
        }

        return $this->redirectToRoute('group-profile_index');
    }

    /**
     * Creates a form to delete a groupProfile entity.
     *
     * @param GroupProfile $groupProfile The groupProfile entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(GroupProfile $groupProfile)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('group-profile_delete', array('id' => $groupProfile->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
