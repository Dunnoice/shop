<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\User;
use AppBundle\Form\Type\RegistrationType;

class AccountController extends Controller
{
	public function registerAction(Request $request)
	{
		$user = new User();
		$em = $this->getDoctrine()->getManager();

		$form = $this->createForm(new RegistrationType(), $user, array(
			'action' => $this->generateUrl('account_register'),
		));

		$form->handleRequest($request);

		if ($form->isValid()) {
			$registration = $form->getData();

			$em->persist($registration->getUser());
			$em->flush();

			return $this->redirect('/');
		}

		return $this->render(
			'AppBundle:Account:register.html.twig',
			array('form' => $form->createView())
		);
	}
}
