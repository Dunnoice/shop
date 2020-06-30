<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\User;
use AppBundle\Form\RegistrationType;

class AccountController extends Controller
{
	/**
	 * @Route("/register", name="registration")
	 */
	public function registerAction(Request $request)
	{
		$user = new User();

		$form = $this->createForm(new RegistrationType(), $user);

		$form->handleRequest($request);

		if ($form->isValid()) {
			$em = $this->getDoctrine()->getManager();

			$em->persist($user);
			$em->flush();

			return $this->redirect($this->generateUrl('index'));
		}

		return $this->render('AppBundle:Account:register.html.twig', ['form' => $form->createView()]);
	}
}
