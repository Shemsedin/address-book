<?php

namespace AppBundle\Controller;

use AppBundle\Entity\AddressBook;
use Doctrine\ORM\OptimisticLockException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use AppBundle\Form\ImageType;

class AddressBookController extends Controller {
  
  /**
   * @Route("/address-book", name="addresses")
   */
  public function indexAction() {
    $addresses = $this->getDoctrine()
      ->getRepository('AppBundle:AddressBook')
      ->findAll();
    
    return $this->render('AddressBookController/index.html.twig', [
      'data' => $addresses,
    ]);
  }
  
  /**
   * @Route("/create", name="create_address")
   */
  public function createAddress(Request $request) {
    $address = new AddressBook();
    $form    = $this->createFormBuilder($address)
      ->add('firstName', TextType::class)
      ->add('lastName', TextType::class)
      ->add('street', TextType::class)
      ->add('zip', TextType::class)
      ->add('city', TextType::class)
      ->add('country', TextType::class)
      ->add('phoneNo', TextType::class)
      ->add('dob', DateType::class, ['widget' => 'choice'])
      ->add('email', TextType::class)
      ->add('save', SubmitType::class, ['label' => 'Add Address'])
      ->getForm();
    
    $form->handleRequest($request);
    try {
      if ($form->isSubmitted() && $form->isValid()) {
        $formData = $form->getData();
        
        // $file     = $address->getPicture();
        // $fileName = md5(uniqid('', TRUE)) . '.' . $file->guessExtension();
        // $file->move($this->getParameter('images_directory'), $fileName);
        // $address->setPicture($fileName);
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($formData);
        $em->flush();
        
        // All data send to DB - redirect the user to the page that shows the
        // details of the entry just created.
        return $this->redirect('/show/' . $address->getId());
      }
    } catch (OptimisticLockException $e) {
      echo 'It seem like someone applying changes to this entity. Please try again.';
    }
    
    return $this->render(
      'AddressBookController/edit.html.twig',
      ['form' => $form->createView()]
    );
  }
  
  /**
   * @Route("/update/{id}", name="update_address")
   */
  public function updateAction($id, Request $request) {
    $em = $this->getDoctrine()->getManager();
    
    
    try {
      $address = $em->getRepository('AppBundle:AddressBook')
        ->find($id);
      if (!$address) {
        throw $this->createNotFoundException(
          'We couldn\'t find any address associated with this id: ' . $id
        );
      }
      $form = $this->createFormBuilder($address)
        ->add('firstName', TextType::class)
        ->add('lastName', TextType::class)
        ->add('street', TextType::class)
        ->add('zip', TextType::class)
        ->add('city', TextType::class)
        ->add('country', TextType::class)
        ->add('phoneNo', TextType::class)
        ->add('dob', DateType::class, ['widget' => 'choice'])
        ->add('email', TextType::class)
        ->add('save', SubmitType::class, ['label' => 'Submit'])
        ->getForm();
      
      $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid()) {
        $address = $form->getData();
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($address);
        $em->flush();
        
        // The address for this person is updated and the user is redirected
        // to the page that shows the updated details.
        return $this->redirect('/show/' . $id);
      }
      else {
        return $this->render('AddressBookController/edit.html.twig',
          ['form' => $form->createView()]);
      }
    } catch (\Exception $e) {
      return new Response($e->getMessage(), 500);
    }
  }
  
  /**
   * @Route("/delete/{id}")
   */
  public function deleteAction($id) {
    $em = $this->getDoctrine()->getManager();
    try {
      $address = $em->getRepository('AppBundle:AddressBook')
        ->find($id);
      if ($address) {
        $em->remove($address);
        $em->flush();
      }
      else {
        throw $this->createNotFoundException(
          'There is no address related to this ' . $id
        );
      }
      
      return $this->redirect('/address-book');
    } catch (\Exception $e) {
      return new Response($e->getMessage(), 500);
    }
  }
  
  /**
   * @Route("/show/{id}")
   */
  public function showAction($id) {
    $address = $this->getDoctrine()
      ->getRepository('AppBundle:AddressBook')
      ->find($id);
    
    // If no id found throw an exception. This can be customised to use its
    // own template but for this purpose will leave like this.
    if (!$address) {
      throw $this->createNotFoundException(
        'No address found for id ' . $id
      );
    }
    
    // Render view template with address details.
    return $this->render(
      'AddressBookController/view.html.twig',
      ['address' => $address]
    );
  }
}
