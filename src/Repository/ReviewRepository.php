<?php

namespace App\Repository;

use App\Entity\Review;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;


class ReviewRepository extends ServiceEntityRepository
{
    /**
     * ReviewRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Review::class);
    }

    /**
     * @return array
     */
    public function findAll()
    {
        return parent::findAll();
    }

    /**
     * @param Review $review
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(Review $review)
    {
        $this->_em->persist($review);
        $this->_em->flush();
    }

    /**
     * @param Review $review
     * @throws \Doctrine\ORM\ORMException
     */
    public function delete(Review $review)
    {
        $this->_em->remove($review);
        $this->_em->flush();
    }

}
