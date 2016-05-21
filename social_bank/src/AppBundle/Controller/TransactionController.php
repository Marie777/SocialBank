<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Account;
use AppBundle\Entity\Transaction;
use AppBundle\Form\Type\TransactionFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TransactionController extends Controller
{
    /**
     * @Route(path="/transaction/create/{id}", name="transaction-create")
     * @Template
     * @param Request $request
     * @param Account $account
     * @return array
     */
    public function createAction(Request $request, Account $account)
    {
        $error = null;
        $om = $this->getDoctrine()->getManager();
        $transaction = new Transaction();
        $transaction->setDueDate(new \DateTime('now'));
        $transaction->setSource($account);
        $form = $this->createForm(TransactionFormType::class, $transaction);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            if($transaction->getSource()->getBalance() >= $transaction->getAmount()){
                $om->persist($transaction);
                $om->flush();
                return $this->redirectToRoute('account-display', ['id' => $account->getId()]);
            }
            $error = "Not enough money in the account!";
        }
        return [
            'form' => $form->createView(),
            'error' => $error
        ];

    }
}
