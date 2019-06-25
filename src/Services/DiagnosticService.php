<?php


namespace App\Services;


use App\Entity\Diagnostic;
use App\Repository\DiagnosticRepository;

class DiagnosticService
{
    private $diagnosticRepository;

    /**
     * DiagnosticService constructor.
     * @param DiagnosticRepository $diagnosticRepository
     */
    public function __construct(DiagnosticRepository $diagnosticRepository)
    {
        $this->diagnosticRepository = $diagnosticRepository;
    }

    /**
     * @return array
     */
    public function getList()
    {
        return $this->diagnosticRepository->findAll();
    }

    /**
     * @param Diagnostic $diagnostic
     */
    public function saveItem(Diagnostic $diagnostic)
    {
        $this->diagnosticRepository->save($diagnostic);
    }

    /**
     * @param Diagnostic $diagnostic
     */
    public function removeItem(Diagnostic $diagnostic)
    {
        $this->diagnosticRepository->delete($diagnostic);
    }
}
