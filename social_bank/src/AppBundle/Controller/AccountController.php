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
        
        $accounts = $user->getAccounts();
//                         ->filter(function(Account $account){
//                             return $account->getStatus() === AccountStatus::ENABLED;
//                         });

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

        

        return $this->redirectToRoute('get-account-list'); //, ["id" => $account->getId()]);
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
     * @Route("/account/{id}/enable", name="account-enable")
     * @Security("has_role('ROLE_USER')")
     * @param Account $account
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function enableAction(Account $account){
        $om = $this->getDoctrine()->getManager();
        $account->setStatus(AccountStatus::ENABLED);
        $om->flush();
        return $this->redirectToRoute('get-account-pending-approval-list');
    }

    /**
     * @Route("/account/{id}/request/disable", name="account-request-disable")
     * @Security("has_role('ROLE_USER')")
     * @param Account $account
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function requestDisableAction(Account $account){
        $om = $this->getDoctrine()->getManager();
        $account->setStatus(AccountStatus::PENDING_DISABLE);
        $om->flush();
        return $this->redirectToRoute('get-account-list');
    }

    /**
     * @Route("/account/{id}/disable", name="account-disable")
     * @Security("has_role('ROLE_USER')")
     * @param Account $account
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function disableAction(Account $account){
        $om = $this->getDoctrine()->getManager();
        $account->setStatus(AccountStatus::DISABLED);
        $om->flush();
        return $this->redirectToRoute('get-account-pending-approval-list');
    }

    /**
     * @Route("/clerk/approvalList", name="get-account-pending-approval-list")
     * @Security("has_role('ROLE_USER')")
     * @Template
     */
    public function getPendingApprovalAction() {

        $om = $this->getDoctrine()->getManager();
        
        $accounts = $om->getRepository(Account::class)->findBy(['status' => AccountStatus::PENDING]);
                       //  ->filter(function(Account $account){
                        //     return $account->getStatus() === AccountStatus::PENDING;
                        // });

        return [
            "accounts" => $accounts
        ];
    }

    /**
     * @Route("/clerk/disableList", name="get-account-pending-disable-list")
     * @Security("has_role('ROLE_USER')")
     * @Template
     */
    public function getPendingDisableAction() {

        $om = $this->getDoctrine()->getManager();
        $accounts = $om->getRepository(Account::class)->findBy(['status' => AccountStatus::PENDING_DISABLE]);
        
        return [
            "accounts" => $accounts
        ];
    }

}