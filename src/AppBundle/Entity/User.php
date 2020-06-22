<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User
 *
 * @ORM\Table()
 * @UniqueEntity(fields="username", message="Username already taken")
 */
class User
{
	/**
	 * @var integer
	 *
	 * @ORM\Id
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="username", type="string", length=20, unique=true)
	 * @Assert\NotBlank()
	 */
	protected $username;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="email", type="string", length=32)
	 * @Assert\NotBlank()
	 * @Assert\Email()
	 */
	protected $email;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="plainPassword", type="string", length=32)
	 * @Assert\NotBlank()
	 * @Assert\Length(max = 4096)
	 */
	protected $plainPassword;


	/**
	 * Get id
	 *
	 * @return integer
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Get username
	 *
	 * @return string
	 */
	public function getUsername()
	{
		return $this->username;
	}

	/**
	 * Set username
	 *
	 * @param string $username
	 *
	 * @return User
	 */
	public function setUsername($username)
	{
		$this->username = $username;

		return $this;
	}

	/**
	 * Get email
	 *
	 * @return string
	 */
	public function getEmail()
	{
		return $this->email;
	}

	/**
	 * Set email
	 *
	 * @param string $email
	 *
	 * @return User
	 */
	public function setEmail($email)
	{
		$this->email = $email;

		return $this;
	}

	/**
	 * Get plainPassword
	 *
	 * @return string
	 */
	public function getPlainPassword()
	{
		return $this->plainPassword;
	}

	/**
	 * Set plainPassword
	 *
	 * @param string $plainPassword
	 *
	 * @return User
	 */
	public function setPlainPassword($plainPassword)
	{
		$this->plainPassword = $plainPassword;

		return $this;
	}
}
