<?php

declare(strict_types = 1);

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 * @UniqueEntity(fields="email", message="Данный e-mail уже используется")
 */
class User implements UserInterface, \Serializable
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="string")
     */
    private $role;

    /**
     * @ORM\Column(type="string")
     */
    private $status;

    /**
     * @ORM\Column(type="phone_number")
     * @AssertPhoneNumber(defaultRegion="UA")
     * @Assert\NotBlank()
     */
    private $phone = null;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min="8",
     *     minMessage="Длинна пароля должна быть не менее {{ limit }} символов",
     *     )
     * @ORM\Column(type="string", length=255)
     */
    private $plainPassword;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

//    /**
//     * @ORM\ManyToOne()
//     */
//    private $biddings;

    /**
     * @ORM\Column(type="string" length=255)
     * @Assert\NotBlank()
     */
    private $company;

    /**
     * @ORM\Column(type="string")
     * @Assert\Length(
     *     min="8",
     *     max="10",
     *     minMessage="Длинна поля должна быть не менее {{ limit }} символов",
     *     maxMessage="Длинна поля должна быть не более {{ limit }} символов",
     * )
     * @Assert\NotBlank()
     */
    private $regNumber;

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getRoles()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function isStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @return mixed
     */
    public function setPlainPassword($password)
    {
        $this->plainPassword = $password;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getSalt()
    {
        return null;
    }

    /**
     * @return mixed
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param mixed $company
     */
    public function setCompany($company)
    {
        $this->company = $company;
    }

    /**
     * @return mixed
     */
    public function getRegNumber()
    {
        return $this->regNumber;
    }

    /**
     * @param mixed $regNumber
     */
    public function setRegNumber($regNumber)
    {
        $this->regNumber = $regNumber;
    }

    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->email,
            $this->password,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->email,
            $this->password,
            ) = unserialize($serialized);
    }
}