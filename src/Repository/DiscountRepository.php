<?php

namespace App\Repository;

use App\Entity\Discount;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;


class DiscountRepository extends ServiceEntityRepository
{
    /**
     * DiscountRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Discount::class);
    }

    /**
     * @return array
     */
    public function findAll()
    {
        return parent::findAll();
    }

    /**
     * @param Discount $discount
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(Discount $discount)
    {
        $this->_em->persist($discount);
        $this->_em->flush();
    }

    /**
     * @param Discount $discount
     * @throws \Doctrine\ORM\ORMException
     */
    public function delete(Discount $discount)
    {
        $this->_em->remove($discount);
        $this->_em->flush();
    }

}
