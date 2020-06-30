<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
	/**
	 * @Route("/", name="index")
	 */
	public function indexAction()
	{
		return $this->render('AppBundle:Default:index.html.twig');
	}
}
