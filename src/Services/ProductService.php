<?php


namespace App\Services;


use App\Entity\Product;
use App\Repository\ProductRepository;

class ProductService
{
    private $productRepository;

    /**
     * ProductService constructor.
     * @param ProductRepository $productRepository
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @return array
     */
    public function getList()
    {
        return $this->productRepository ->findAll();
    }

    /**
     * @param Product $product
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function saveItem(Product $product)
    {
        $this->productRepository ->save($product);
    }

    /**
     * @param Product $product
     * @throws \Doctrine\ORM\ORMException
     */
    public function removeItem(Product $product)
    {
        $this->productRepository ->delete($product);
    }
}
