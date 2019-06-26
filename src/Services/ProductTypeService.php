<?php


namespace App\Services;


use App\Entity\ProductType;
use App\Repository\ProductTypeRepository;

class ProductTypeService
{
    private $productTypeRepository;

    /**
     * ProductTypeService constructor.
     * @param ProductTypeRepository $productTypeRepository
     */
    public function __construct(ProductTypeRepository $productTypeRepository)
    {
        $this->productTypeRepository = $productTypeRepository;
    }

    /**
     * @return array
     */
    public function getList()
    {
        return $this->productTypeRepository ->findAll();
    }

    /**
     * @param ProductType $productType
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function saveItem(ProductType $productType)
    {
        $this->productTypeRepository ->save($productType);
    }

    /**
     * @param ProductType $productType
     * @throws \Doctrine\ORM\ORMException
     */
    public function removeItem(ProductType $productType)
    {
        $this->productTypeRepository ->delete($productType);
    }
}
