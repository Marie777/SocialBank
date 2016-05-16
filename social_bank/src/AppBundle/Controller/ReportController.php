<?php
/**
 * Created by PhpStorm.
 * User: Mmarie
 * Date: 5/15/2016
 * Time: 9:06 AM
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Report;
use AppBundle\Entity\Transaction;
use AppBundle\Form\Type\CreateReportFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ReportController extends Controller
{

    /**
     * @Route("/report", name="get-report-list")
     * @Security("has_role('ROLE_USER')")
     * @Template
     */
    public function getAllAction() {

        $reports = $this->getDoctrine()->getManager()->getRepository(Report::class)->findAll();

        return [
            "reports" => $reports
        ];
    }

    /**
     * @Route("/report/create", name="create-report")
     * @param Request $request
     * @Template
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function createAction(Request $request){

        $om = $this->getDoctrine()->getManager();

        $report = new Report();
        $report->setEndDate(new \DateTime('now'));

        $form = $this->createForm(CreateReportFormType::class, $report);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $om->persist($report);
            $om->flush();
            return $this->redirectToRoute('get-report-list');
        }
        /** @var TYPE_NAME $form */
        return ['form' => $form->createView()];

    }

    /**
     * @Route("/report/{id}/display", name="display-report")
     * @Template
     * @param Report $report
     * @return array
     */
    public function displayAction(Report $report){
        $om = $this->getDoctrine()->getManager();
        $allTransactions = $om->getRepository(Transaction::class)
                              ->findRangeDate($report->getStartDate(),$report->getEndDate());
        
        
        $countTransactions = count($allTransactions);
        $maxAmountTransaction = max(array_map(function(Transaction $transaction){
            return $transaction->getAmount();
        }, $allTransactions));


        return [
           "countTransactions"=> $countTransactions,
           "maxAmountTransaction" => $maxAmountTransaction
        ];
    }

}
