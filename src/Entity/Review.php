<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="reviews")
 * @ORM\Entity(repositoryClass="App\Repository\ReviewRepository")
 */
class Review
{
    /**
     * @var int $id
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string $description
     * @ORM\Column(type="text", nullable=false)
     */
    private $description;

    /**
     * @var User
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="reviews")
     */
    private $user;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return ArrayCollection|null
     */
    public function getUser(): ?ArrayCollection
    {
        return $this->user;
    }

    /**
     * @param User $user
    */
    public function setUser(User $user): void
    {
        $this->user[] = $user;
    }

}
