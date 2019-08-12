<?php


namespace App\Controller;


use App\Entity\ProductType;
use App\Form\ProductTypeType;
use App\Services\ProductTypeService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ProductTypeController extends AbstractController
{
    private $productTypeService;

    /**
     * ProductTypeController constructor.
     * @param ProductTypeService $productTypeService
     */
    public function __construct(ProductTypeService $productTypeService)
    {
        $this->productTypeService = $productTypeService;
    }

    /**
     * @Route("/product-types", name="product_types", methods={"GET"})
    */
    public function index()
    {
        $list = $this->productTypeService->getList();
        return $this->render('product-types/index.html.twig', [
            'list' => $list
        ]);
    }

    /**
     * @Route("product-types/add", name="product_type_add")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function addProductType(Request $request)
    {
        $productType = new ProductType();
        $form = $this->createForm(ProductTypeType::class, $productType);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->productTypeService->saveItem($productType);
            return $this->redirectToRoute('product_types');
        }

        return $this->render('product-types/add-edit.html.twig', [
            'form' => $form->createView(),
            'mode' => 'add'
        ]);
    }

    /**
     * @Route("product-types/edit/{productTypeId}", name="product_type_edit")
     * @param Request $request
     * @param ProductType $productType
     * @ParamConverter("productType", options={"mapping": {"productTypeId" : "id"}})
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function editProductType(Request $request, ProductType $productType, $productTypeId = 1)
    {
        $form = $this->createForm(ProductTypeType::class, $productType);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->productTypeService->saveItem($productType);
            return $this->redirectToRoute('product_types');
        }

        return $this->render('product-types/add-edit.html.twig', [
            'form' => $form->createView(),
            'mode' => 'edit'
        ]);
    }


    /**
     * @Route("product-types/delete/{productTypeId}", name="product_type_delete")
     * @ParamConverter("productType", options={"mapping": {"productTypeId" : "id"}})
     * @param ProductType $productType
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \Doctrine\ORM\ORMException
     */
    public function deleteProductType(ProductType $productType)
    {
        $this->productTypeService->removeItem($productType);
        return $this->redirectToRoute('product_types');
    }
}
