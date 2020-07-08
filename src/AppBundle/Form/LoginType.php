<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LoginType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('_username', 'text', ['data' => $options['last_username']]);
		$builder->add('_password', 'password', ['label' => 'Password']);
		$builder->add('Log in', 'submit');
	}

	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults([
				'data_class'    => 'AppBundle\Entity\User',
				'last_username' => NULL,
			]
		);
	}

	/**
	 * @inheritDoc
	 */
	public function getName()
	{
		// To prevent Symfony from changing the input names by enclosing them in login[...]
		return NULL;
	}
}

