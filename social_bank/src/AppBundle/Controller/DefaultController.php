<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/temp", name="homepage")
     * @Template
     */
    public function indexAction(Request $request)
    {
        $userName = "nadir";
        $money = 100;
        
        
        return [
            "name" => $userName,
            "money" => $money
        ];
    }
}
