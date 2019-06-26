<?php

namespace App\Repository;

use App\Entity\ProductType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;


class ProductTypeRepository extends ServiceEntityRepository
{
    /**
     * ProductTypeRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ProductType::class);
    }

    /**
     * @return array
     */
    public function findAll()
    {
        return parent::findAll();
    }

    /**
     * @param ProductType $productType
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(ProductType $productType)
    {
        $this->_em->persist($productType);
        $this->_em->flush();
    }

    /**
     * @param ProductType $productType
     * @throws \Doctrine\ORM\ORMException
     */
    public function delete(ProductType $productType)
    {
        $this->_em->remove($productType);
        $this->_em->flush();
    }

}
