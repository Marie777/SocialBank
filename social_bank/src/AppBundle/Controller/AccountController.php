<?php


namespace AppBundle\Controller;

use AppBundle\DBAL\AccountStatus;
use AppBundle\Entity\Account;
use AppBundle\Entity\Customer;
use AppBundle\Entity\Transaction;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AccountController extends Controller {

    /**
     * @Route("/", name="get-account-list")
     * @Security("has_role('ROLE_USER')")
     * @Template
     */
    public function getAllAction() {
        /** @var Customer $user */
        $user = $this->getUser();
        
        $accounts = $user->getAccounts()
                         ->filter(function(Account $account){
                             return $account->getStatus() === AccountStatus::ENABLED;
                         });

        return [
            "accounts" => $accounts
        ];
    }

    /**
     * @Route("/account/create", name="create-account")
     * @Security("has_role('ROLE_USER')")
     */
    public function createAction() {
        /** @var Customer $user */
        $user = $this->getUser();

        $om = $this->getDoctrine()->getManager();

        $account = new Account();
        
        $account->setCustomer($user);

        $om->persist($account);

        $om->flush();

        return $this->redirectToRoute('account-display', ["id" => $account->getId()]);
    }

    /**
     * @Route("/account/{id}", name="account-display")
     * @Security("has_role('ROLE_USER')")
     * @Template
     * @param Account $account
     * @return array
     */
    public function displayAction(Account $account) {
        $income = $account->getIncome()->toArray();
        $expense = $account->getExpense()->toArray();

        $allTransactions = array_merge($income, $expense);

        /** @var Transaction[] $allTransactions */
        usort($allTransactions, function(Transaction $a, Transaction $b){
            if($a->getDueDate() >= $b->getDueDate()) {
                return 1;
            } else {
                return -1;
            }
        });

        return [
            "account" => $account,
            "transactions" => $allTransactions
        ];
    }

    /**
     * @Route("/account/{id}/disable", name="account-disable")
     * @Security("has_role('ROLE_USER')")
     * @param Account $account
     */
    public function disableAction(Account $account){
        $account->setStatus(AccountStatus::DISABLED);
    }
}