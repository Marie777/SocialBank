<?php


namespace AppBundle\Controller;

use AppBundle\Entity\Customer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AccountController extends Controller {

    /**
     * @Route("/", name="getAccountList")
     * @Security("has_role('ROLE_USER')")
     * @Template
     */
    function getAccountListAction() {
        /** @var Customer $user */
        $user = $this->getUser();
        
        $accounts = $user->getAcoounts();

        return [
            "account" => $accounts
        ];
    }

    /**
     * @Route("/register/customer", name="customer-registration")
     * @Template
     */
    public function registrationAction() {
        return $this->get('pugx_multi_user.registration_manager')
                    ->register('AppBundle\Entity\Customer');
    }
}