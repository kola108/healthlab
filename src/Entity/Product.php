<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="products")
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
{
    /**
     * @var int $id
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string $nameShort
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $nameShort;

    /**
     * @var string $nameFull
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $nameFull;

    /**
     * @var string|null $description
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var float $priceBase
     * @ORM\Column( type="decimal", precision=10, scale=2, nullable=false)
     */
    private $priceBase;

    /**
    * @var ArrayCollection
    * @ORM\ManyToMany(targetEntity="App\Entity\BodySystem", inversedBy="products")
    */
    private $bodySystems;

    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="App\Entity\MedicationGoal", inversedBy="products")
     */
    private $medicationGoals;

    /**
     * @var ProductType
     * @ORM\ManyToOne(targetEntity="App\Entity\ProductType", inversedBy="products")
     */
    private $productType;

    /**
     * Products constructor.
     * @param string $nameShort
     * @param string $nameFull
     * @param string|null $description
     * @param float $priceBase
     */
    public function __construct(string $nameShort, string $nameFull, ?string $description, float $priceBase)
    {
        $this->nameShort = $nameShort;
        $this->nameFull = $nameFull;
        $this->description = $description;
        $this->priceBase = $priceBase;
        $this->bodySystems = new ArrayCollection();
        $this->medicationGoals = new ArrayCollection();
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
    public function getNameShort(): string
    {
        return $this->nameShort;
    }

    /**
     * @param string $nameShort
     */
    public function setNameShort(string $nameShort): void
    {
        $this->nameShort = $nameShort;
    }

    /**
     * @return string
     */
    public function getNameFull(): string
    {
        return $this->nameFull;
    }

    /**
     * @param string $nameFull
     */
    public function setNameFull(string $nameFull): void
    {
        $this->nameFull = $nameFull;
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
     * @return float
     */
    public function getPriceBase(): float
    {
        return $this->priceBase;
    }

    /**
     * @param float $priceBase
     */
    public function setPriceBase(float $priceBase): void
    {
        $this->priceBase = $priceBase;
    }

    /**
     * @return ArrayCollection
     */
    public function getBodySystems(): ArrayCollection
    {
        return $this->bodySystems;
    }

    /**
     * @param BodySystem $bodySystem
     */
    public function addBodySystem(BodySystem $bodySystem): void {
        $this->bodySystems[] = $bodySystem;
    }

    /**
     * @param BodySystem $bodySystem
     */
    public function removeBodySystem(BodySystem $bodySystem): void {
        $this->bodySystems->removeElement($bodySystem);
    }

    /**
     * @return ArrayCollection
     */
    public function getMedicationGoals(): ArrayCollection
    {
        return $this->medicationGoals;
    }

    /**
     * @param MedicationGoal $medicationGoal
    */
    public function addMedicationGoal(MedicationGoal $medicationGoal): void
    {
        $this->medicationGoals[] = $medicationGoal;
    }

    /**
     * @param MedicationGoal $medicationGoal
     */
    public function removeMedicationGoal(MedicationGoal $medicationGoal): void
    {
        $this->medicationGoals->removeElement($medicationGoal);
    }

    /**
     * @return ProductType
     */
    public function getProductType(): ProductType
    {
        return $this->productType;
    }

    /**
     * @param ProductType $productType
    */
    public function setProductType(ProductType $productType): void
    {
        $this->productType = $productType;
    }

}
