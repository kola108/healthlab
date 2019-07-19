<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity(fields={"email"}, message="profileDetails.email_unique")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="profileDetails.not_blank")
     */
    private $firstname;
    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="profileDetails.not_blank")
     */
    private $lastname;
    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    private $password;

    private $plainPassword;
    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $email;
    /**
     * @ORM\Column(name="activation_hash", type="string", length=255, nullable=true)
     */
    private $activationHash;
    /**
     * @ORM\Column(name="password_reset_hash", type="string", length=255, nullable=true)
     */
    private $passwordResetHash;
    /**
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;
    /**
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     */
    private $deletedAt;
    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];
    /**
     * @ORM\Column(name="token_expires_at", type="datetime", nullable=true)
     */
    private $tokenExpiresAt;
    /**
     * @ORM\Column(type="boolean", options={"default":true})
     */
    private $isActive = true;

    /**
     * @return string
     */
    public function __toString() {
        return $this->email;
    }

    /**
     * Get id
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Get firstname
     * @return string
     */
    public function getFirstname() {
        return $this->firstname;
    }

    /**
     * Set firstname
     * @param string $firstname
     * @return User
     */
    public function setFirstname($firstname) {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * Get lastname
     * @return string
     */
    public function getLastname() {
        return $this->lastname;
    }

    /**
     * Set lastname
     * @param string $lastname
     * @return User
     */
    public function setLastname($lastname) {
        $this->lastname = $lastname;
        return $this;
    }

    /**
     * Get email
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Set email
     * @param string $email
     * @return User
     */
    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getUserName() {
        return $this->email;
    }

    /**
     * @inheritDoc
     */
    public function getSalt() {
        return null;
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials() {
    }

    /**
     * @inheritDoc
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * Set password
     * @param string $password
     * @return User
     */
    public function setPassword($password) {
        $this->password = $password;
        return $this;
    }

    /**
     * Get plainPassword
     * @return string
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * Set plainPassword
     * @param string $plainPassword
     * @return User
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
        return $this;
    }

    /**
     * Get activationHash
     * @return string
     */
    public function getActivationHash() {
        return $this->activationHash;
    }

    /**
     * Set hash
     * @param string $activationHash
     * @return User
     */
    public function setActivationHash($activationHash = null) {
        $this->activationHash = $activationHash;
        return $this;
    }

    /**
     * Get passwordResetHash
     * @return string
     */
    public function getPasswordResetHash() {
        return $this->passwordResetHash;
    }

    /**
     * Set passwordResetHash
     * @param string $passwordResetHash
     * @return User
     */
    public function setPasswordResetHash($passwordResetHash = null) {
        $this->passwordResetHash = $passwordResetHash;
        return $this;
    }

    /**
     * Get createdAt
     * @return \DateTime
     */
    public function getCreatedAt() {
        return $this->createdAt;
    }

    /**
     * Set createdAt
     * @ORM\PrePersist
     */
    public function setCreatedAt($createdAt) {
        $this->createdAt = new \DateTime();
    }

    /**
     * Get deletedAt
     * @return \DateTime
     */
    public function getDeletedAt() {
        return $this->deletedAt;
    }

    /**
     * Set deletedAt
     */
    public function setDeletedAt($deletedAt) {
        $this->deletedAt = new \DateTime();
    }

    /**
     * @inheritDoc
     */
    public function getRoles()
    {
        $roles = $this->roles;
        // guarantees that a user always has at least one role for security
        if (empty($roles)) {
            $roles[] = 'ROLE_USER';
        }
        return array_unique($roles);
    }

    /**
     * Set roles
     * @return User
     */
    public function setRoles(array $roles)
    {
        $this->roles = $roles;
    }

    public function getUserRole() {
        foreach ($this->roles as $role) {
            return $role;
        }
    }

    /**
     * @return mixed
     */
    public function getTokenExpiresAt()
    {
        return $this->tokenExpiresAt;
    }

    /**
     * @param mixed $tokenExpiresAt
     * @return User
     */
    public function setTokenExpiresAt($tokenExpiresAt = null)
    {
        $this->tokenExpiresAt = $tokenExpiresAt;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * @param mixed $isActive
     * @return User
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
        return $this;
    }

    /**
     * @return bool
     */
    public function isAuthenticationUser()
    {
        if (is_null($this->getActivationHash())) {
            return true;
        }

        return false;
    }

}
