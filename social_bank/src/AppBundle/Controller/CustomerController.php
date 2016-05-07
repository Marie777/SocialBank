<?php


namespace AppBundle\Controller;

use AppBundle\Entity\Customer;
use AppBundle\Form\Type\UpdateCustomerFormType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CustomerController extends Controller {
    /**
     * @Route("/customer/register", name="fos_user_registration_register")
     * @Template
     */
    public function registrationAction() {
        return $this->get('pugx_multi_user.registration_manager')
            ->register(Customer::class);
    }

    /**
     * @Route("/customer/register/success", name="fos_user_registration_confirmed")
     * @Template
     */
    public function registrationConfirmedAction() {
        return [];
    }

    /**
     * @Route("/customer/{id}/update", name="Customer-update")
     * @Template
     * @param Customer $customer
     * @param Request $request
     * @return array
     */
    public function updateAction(Customer $customer, Request $request){

        $om = $this->getDoctrine()->getManager();
        $form = $this->createForm(UpdateCustomerFormType::class, $customer);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $om->persist($customer);
            $om->flush();
            return $this->redirectToRoute('get-account-list');
        }
        return ['form' => $form->createView()];
    }

}