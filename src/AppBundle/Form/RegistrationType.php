<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RegistrationType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('email', 'email');
		$builder->add('username', 'text');
		$builder->add('plainPassword', 'repeated', [
				'type'           => 'password',
				'first_options'  => ['label' => 'Password'],
				'second_options' => ['label' => 'Repeat Password'],
			]
		);
		$builder->add('Register', 'submit');
	}

	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults([
				'data_class' => 'AppBundle\Entity\User',
			]
		);
	}

	/**
	 * @inheritDoc
	 */
	public function getName()
	{
		return 'registration';
	}
}

