<?php


namespace App\Controller;


use App\Entity\Discount;
use App\Form\DiscountType;
use App\Services\DiscountService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class DiscountController extends AbstractController
{
    private $discountService;

    /**
     * DiscountController constructor.
     * @param DiscountService $discountService
     */
    public function __construct(DiscountService $discountService)
    {
        $this->discountService = $discountService;
    }

    /**
     * @Route("/discounts", name="discounts")
     * @Method("GET")
    */
    public function index()
    {
        $list = $this->discountService->getList();
        return $this->render('discount/index.html.twig', [
            'list' => $list
        ]);
    }

    /**
     * @Route("discounts/add", name="discount_add")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function addDiscount(Request $request)
    {
        $discount = new Discount();
        $form = $this->createForm(DiscountType::class, $discount);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->discountService->saveItem($discount);
            return $this->redirectToRoute('discounts');
        }

        return $this->render('discount/add-edit.html.twig', [
            'form' => $form->createView(),
            'mode' => 'add'
        ]);
    }

    /**
     * @Route("discounts/edit/{discountId}", name="discount_edit")
     * @param Request $request
     * @param Discount $discount
     * @ParamConverter("discount", options={"mapping": {"discountId" : "id"}})
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function editDiscount(Request $request, Discount $discount)
    {
        $form = $this->createForm(DiscountType::class, $discount);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->discountService->saveItem($discount);
            return $this->redirectToRoute('discounts');
        }

        return $this->render('discount/add-edit.html.twig', [
            'form' => $form->createView(),
            'mode' => 'edit'
        ]);
    }


    /**
     * @Route("discounts/delete/{discountId}", name="discount_delete")
     * @Method("DELETE")
     * @ParamConverter("discount", options={"mapping": {"discountId" : "id"}})
     * @param Discount $discount
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \Doctrine\ORM\ORMException
     */
    public function deleteDiscount(Discount $discount)
    {
        $this->discountService->removeItem($discount);
        return $this->redirectToRoute('discounts');
    }
}
