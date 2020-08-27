<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User
 *
 * @ORM\Entity
 * @ORM\Table(name="users")
 * @UniqueEntity(fields="username", message="Username already taken")
 */
class User implements UserInterface
{
	/**
	 * @var integer
	 *
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;

	/**
	 * @var string
	 *
	 * @ORM\Column(type="string", length=64, unique=true)
	 * @Assert\NotBlank()
	 */
	private $username;

	/**
	 * @var string
	 *
	 * @ORM\Column(type="string", length=32)
	 * @Assert\NotBlank()
	 * @Assert\Email()
	 */
	private $email;

	/**
	 * @var string
	 *
	 * @Assert\NotBlank()
	 * @Assert\Length(max = 4096)
	 */
	private $plainPassword;

	/**
	 * @var string
	 *
	 * @ORM\Column(type="string", length=64)
	 */
	private $password;

	/**
	 * @var array
	 *
	 * @ORM\Column(type="json_array")
	 */
	private $roles;


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
	 * @inheritDoc
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

	/**
	 * @inheritDoc
	 */
	public function getPassword()
	{
		return $this->password;
	}

	/**
	 * Set password
	 *
	 * @param string $password
	 *
	 * @return User
	 */
	public function setPassword($password)
	{
		$this->password = $password;

		return $this;
	}

	/**
	 * @inheritDoc
	 */
	public function getSalt()
	{
		// The bcrypt algorithm doesn't require a separate salt.
		// You *may* need a real salt if you choose a different encoder.
		return NULL;
	}

	/**
	 * @inheritDoc
	 */
	public function getRoles()
	{
		$roles = $this->roles;
		// guarantee every user at least has ROLE_USER
		$roles[] = 'ROLE_USER';

		return array_unique($roles);
	}

	/**
	 * Set roles
	 *
	 * @param array $roles
	 *
	 * @return User
	 */
	public function setRoles(array $roles)
	{
		$this->roles = $roles;

		return $this;
	}

	/**
	 * @inheritDoc
	 */
	public function eraseCredentials()
	{
		$this->plainPassword = NULL;
	}
}
