<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="discounts")
 * @ORM\Entity(repositoryClass="App\Repository\DiscountRepository")
 */
class Discount
{
    /**
     * @var int $id
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string $name
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $name;


    /**
     * @var int $percentage
     * @ORM\Column( type="integer", nullable=false)
     */
    private $percentage;

    /**
     * Discount constructor.
     * @param string $name
     * @param int $percentage
     */
    public function __construct(string $name, int $percentage)
    {
        $this->name = $name;
        $this->percentage = $percentage;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getPercentage(): int
    {
        return $this->percentage;
    }

    /**
     * @param int $percentage
     */
    public function setPercentage(int $percentage): void
    {
        $this->percentage = $percentage;
    }

}
