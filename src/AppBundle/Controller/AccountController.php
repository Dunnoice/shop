<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\LoginType;
use AppBundle\Form\RegistrationType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\SecurityContextInterface;

class AccountController extends Controller
{
	/**
	 * firewall plugs
	 *
	 * @Route("/login_check", name="login_check")
	 * @Route("/logout", name="logout")
	 */
	public function emptyAction() { }

	/**
	 * @Route("/login", name="login")
	 */
	public function loginAction(Request $request)
	{
		$session = $request->getSession();

		// Symfony\Component\Security\Core\Exception\AuthenticationException
		if ($request->attributes->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
			$error = $request->attributes->get(SecurityContextInterface::AUTHENTICATION_ERROR);
		} else if (NULL !== $session && $session->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
			$error = $session->get(SecurityContextInterface::AUTHENTICATION_ERROR);
			$session->remove(SecurityContextInterface::AUTHENTICATION_ERROR);
		} else {
			$error = NULL;
		}

		$lastUsername = (NULL === $session) ? '' : $session->get(SecurityContextInterface::LAST_USERNAME);

		$form = $this->createForm(new LoginType(), NULL,
			[
				'action'        => $this->generateUrl('login_check'),
				'last_username' => $lastUsername,
			]
		);
		if ($error) {
			$form->addError(new FormError($error->getMessageKey()));
		}

		return $this->render(
			'AppBundle:Account:login.html.twig',
			['form' => $form->createView()]
		);
	}

	/**
	 * @Route("/register", name="registration")
	 */
	public function registerAction(Request $request)
	{
		$user = new User();

		$form = $this->createForm(new RegistrationType(), $user);

		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$user->setRoles(['ROLE_USER']);
			// or else PDOException: SQLSTATE[23000]: Integrity constraint violation: 1048 Column 'roles' cannot be null

			$encoder  = $this->get('security.encoder_factory')->getEncoder($user);
			$password = $encoder->encodePassword($user->getPlainPassword(), $user->getSalt());
			$user->setPassword($password);

			$em = $this->getDoctrine()->getManager();
			$em->persist($user);
			$em->flush();

			// autologin
			$this->container->get('security.context')
			                ->setToken(new UsernamePasswordToken($user, NULL, 'default', $user->getRoles()))
			;

			return $this->redirect($this->generateUrl('index'));
		}

		return $this->render(
			'AppBundle:Account:register.html.twig',
			['form' => $form->createView()]
		);
	}
}
