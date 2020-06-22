<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RegistrationType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('email', 'email');
		$builder->add('username', 'text');
		$builder->add('plainPassword', 'repeated', array(
			'first_name'  => 'password',
			'second_name' => 'confirm',
			'type'        => 'password',
		));
		$builder->add('Register', 'submit');
	}

	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => 'AppBundle\Entity\User'
		));
	}

	/**
	 * @inheritDoc
	 */
	public function getName()
	{
		return 'registration';
	}
}

