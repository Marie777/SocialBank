<?php


namespace AppBundle\Controller;

use AppBundle\Entity\Customer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CustomerController extends Controller {
    /**
     * @Route("/register/customer", name="fos_user_registration_register")
     * @Template
     */
    public function registrationAction() {
        return $this->get('pugx_multi_user.registration_manager')
            ->register(Customer::class);
    }

    /**
     * @Route("/register/customer/success", name="fos_user_registration_confirmed")
     * @Template
     */
    public function registrationConfirmedAction() {
        return [];
    }

}