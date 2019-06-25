<?php


namespace App\Services;


use App\Entity\Discount;
use App\Repository\DiscountRepository;

class DiscountService
{
    private $discountRepository;

    /**
     * DiscountService constructor.
     * @param DiscountRepository $discountRepository
     */
    public function __construct(DiscountRepository $discountRepository)
    {
        $this->discountRepository = $discountRepository;
    }

    /**
     * @return array
     */
    public function getList()
    {
        return $this->discountRepository->findAll();
    }

    /**
     * @param Discount $discount
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function saveItem(Discount $discount)
    {
        $this->discountRepository->save($discount);
    }

    /**
     * @param Discount $discount
     * @throws \Doctrine\ORM\ORMException
     */
    public function removeItem(Discount $discount)
    {
        $this->discountRepository->delete($discount);
    }
}
