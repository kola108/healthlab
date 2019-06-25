<?php

namespace App\Repository;

use App\Entity\Diagnostic;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;


class DiagnosticRepository extends ServiceEntityRepository
{
    /**
     * DiagnosticRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Diagnostic::class);
    }

    /**
     * @return array
     */
    public function findAll()
    {
        return parent::findAll();
    }

    /**
     * @param Diagnostic $diagnostic
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(Diagnostic $diagnostic)
    {
        $this->_em->persist($diagnostic);
        $this->_em->flush();
    }

    /**
     * @param Diagnostic $diagnostic
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete(Diagnostic $diagnostic)
    {
        $this->_em->remove($diagnostic);
        $this->_em->flush();
    }

}
