<?php


namespace App\Services;


use App\Entity\Review;
use App\Repository\ReviewRepository;

class ReviewService
{
    private $reviewRepository;

    /**
     * ProductTypeService constructor.
     * @param ReviewRepository $reviewRepository
     */
    public function __construct(ReviewRepository $reviewRepository)
    {
        $this->reviewRepository = $reviewRepository;
    }

    /**
     * @return array
     */
    public function getList()
    {
        return $this->reviewRepository ->findAll();
    }

    /**
     * @param Review $review
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function saveItem(Review $review)
    {
        $this->reviewRepository ->save($review);
    }

    /**
     * @param Review $review
     * @throws \Doctrine\ORM\ORMException
     */
    public function removeItem(Review $review)
    {
        $this->reviewRepository ->delete($review);
    }
}
