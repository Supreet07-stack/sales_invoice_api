<?php

namespace App\Services;

use App\DTOs\SalesInvoiceDTO;
use App\Http\Repositories\SalesInvoiceRepository;
use App\Models\SalesInvoice;

class SalesInvoiceService
{
    public function __construct(private SalesInvoiceRepository $salesInvoiceRepository,private ExactOnlineService $exactOnlineService) {
        $this->salesInvoiceRepository = $salesInvoiceRepository;
        $this->exactOnlineService = $exactOnlineService;
    }


    /**
     * @param SalesInvoiceDTO $data
     * @return SalesInvoice
     */
    public function create(SalesInvoiceDTO $data): SalesInvoice
    {
        $invoice =  $this->salesInvoiceRepository->createInvoiceWithLines($data);
        if ($invoice->id) {
            $this->exactOnlineService->sendInvoiceToExact($invoice);
        }

        return $invoice;
    }
}
