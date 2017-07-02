<?php

namespace ParkimeterAffiliates\SharedBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DocsController extends Controller
{
    public function indexAction()
    {
        return $this->render('ParkimeterAffiliatesSharedBundle:Docs:index.html.twig');
    }
}
