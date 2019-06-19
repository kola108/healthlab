<?php

namespace App\Controller;

use App\Entity\Diagnostic;
use App\Form\DiagnosticType;
use App\Services\DiagnosticService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DiagnosticController extends AbstractController
{
    private $diagnosticService;

    /**
     * DiagnosticController constructor.
     */
    public function __construct(DiagnosticService $diagnosticService)
    {
        $this->diagnosticService = $diagnosticService;
    }

    /**
     * @Route("/diagnostic", name="diagnostic")
     * @Method("GET")
     */
    public function index()
    {
        $list = $this->diagnosticService->getList();
        return $this->render('diagnostic/index.html.twig', [
            'list' => $list
        ]);
    }

    /**
     * @Route("diagnostic/add", name="diagnostic_add")
     * @Method("POST")
     * @param Request $request
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addDiagnostic(Request $request)
    {
        $diagnostic = new Diagnostic();
        $form = $this->createForm(DiagnosticType::class, $diagnostic);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->diagnosticService->addItem($diagnostic);
            return $this->redirectToRoute('diagnostic');
        }

        return $this->render('diagnostic/add-edit.html.twig', [
            'form' => $form->createView(),
            'mode' => 'add'
        ]);
    }

    /**
     * @Route("diagnostic/edit/{diagnosticId}", name="diagnostic_edit")
     * @Method("PUT")
     * @ParamConverter("diagnostic", options={"mapping": {"diagnosticId": "id"}})
     * @param Request $request
     * @param Diagnostic $diagnostic
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function updateDiagnostic(Request $request, Diagnostic $diagnostic)
    {
        $form = $this->createForm(DiagnosticType::class, $diagnostic);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->diagnosticService->saveItem($diagnostic);
            return $this->redirectToRoute('diagnostic');
        }

        return $this->render('diagnostic/add-edit.html.twig', [
            'form' => $form->createView(),
            'mode' => 'edit'
        ]);
    }

    /**
     * @Route("diagnostic/delete/{diagnosticId}", name="diagnostic_delete")
     * @Method("DELETE")
     * @ParamConverter("diagnostic", options={"mapping": {"diagnosticId": "id"}})
     * @param Diagnostic $diagnostic
     * @return RedirectResponse
     */
    public function removeDiagnostic(Diagnostic $diagnostic)
    {
        $this->diagnosticService->removeItem($diagnostic);
        return $this->redirectToRoute('diagnostic');
    }

}
