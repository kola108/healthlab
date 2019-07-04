<?php


namespace App\Controller;


use App\Entity\Product;
use App\Form\ProductType;
use App\Services\ProductService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends AbstractController
{
    private $productService;

    /**
     * ProductController constructor.
     * @param ProductService $productService
     */
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * @Route("/products", name="products")
     * @Method("GET")
    */
    public function index()
    {
        $list = $this->productService->getList();
        return $this->render('products/index.html.twig', [
            'list' => $list
        ]);
    }

    /**
     * @Route("products/add", name="product_add")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function addProduct(Request $request)
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->productService->saveItem($product);
            return $this->redirectToRoute('products');
        }

        return $this->render('products/add-edit.html.twig', [
            'form' => $form->createView(),
            'mode' => 'add'
        ]);
    }

    /**
     * @Route("products/edit/{productId}", name="product_edit")
     * @param Request $request
     * @param Product $product
     * @ParamConverter("product", options={"mapping": {"productId" : "id"}})
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function editProduct(Request $request, Product $product)
    {
        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->productService->saveItem($product);
            return $this->redirectToRoute('products');
        }

        return $this->render('products/add-edit.html.twig', [
            'form' => $form->createView(),
            'mode' => 'edit'
        ]);
    }


    /**
     * @Route("products/delete/{productId}", name="product_delete")
     * @Method("DELETE")
     * @ParamConverter("product", options={"mapping": {"productId" : "id"}})
     * @param Product $product
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \Doctrine\ORM\ORMException
     */
    public function deleteProduct(Product $product)
    {
        $this->productService->removeItem($product);
        return $this->redirectToRoute('products');
    }
}
