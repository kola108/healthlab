<?php


namespace App\Controller;


use App\Entity\Review;
use App\Form\ReviewType;
use App\Services\ReviewService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ReviewController extends AbstractController
{
    private $reviewService;

    /**
     * ReviewController constructor.
     * @param ReviewService $reviewService
     */
    public function __construct(ReviewService $reviewService)
    {
        $this->reviewService = $reviewService;
    }

    /**
     * @Route("/reviews", name="reviews", methods={"GET"})
    */
    public function index()
    {
        $list = $this->reviewService->getList();
        return $this->render('reviews/index.html.twig', [
            'list' => $list
        ]);
    }

    /**
     * @Route("reviews/add", name="review_add")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function addReview(Request $request)
    {
        $review = new Review();
        $form = $this->createForm(ReviewType::class, $review);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->reviewService->saveItem($review);
            return $this->redirectToRoute('reviews');
        }

        return $this->render('reviews/add-edit.html.twig', [
            'form' => $form->createView(),
            'mode' => 'add'
        ]);
    }

    /**
     * @Route("reviews/edit/{reviewId}", name="review_edit")
     * @param Request $request
     * @param Review $review
     * @ParamConverter("review", options={"mapping": {"reviewId" : "id"}})
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function editReview(Request $request, Review $review, $reviewId = 1)
    {
        $form = $this->createForm(ReviewType::class, $review);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->reviewService->saveItem($review);
            return $this->redirectToRoute('reviews');
        }

        return $this->render('reviews/add-edit.html.twig', [
            'form' => $form->createView(),
            'mode' => 'edit'
        ]);
    }


    /**
     * @Route("reviews/delete/{reviewId}", name="review_delete")
     * @ParamConverter("review", options={"mapping": {"reviewId" : "id"}})
     * @param Review $review
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \Doctrine\ORM\ORMException
     */
    public function deleteReview(Review $review)
    {
        $this->reviewService->removeItem($review);
        return $this->redirectToRoute('reviews');
    }
}
