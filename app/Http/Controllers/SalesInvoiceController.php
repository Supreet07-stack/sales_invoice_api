<?php

namespace App\Http\Controllers;

use App\DTOs\SalesInvoiceDTO;
use App\Http\Requests\StoreSalesInvoiceRequest;
use App\Services\SalesInvoiceService;
use Illuminate\Http\JsonResponse;

class SalesInvoiceController extends Controller
{
    public function __construct(private SalesInvoiceService $salesInvoiceService) {
        $this->salesInvoiceService = $salesInvoiceService;
    }


    /** creates the sales invoice
     * @param StoreSalesInvoiceRequest $request
     * @return JsonResponse
     *
     */
    public function create(StoreSalesInvoiceRequest $request): JsonResponse
    {
        $dto = SalesInvoiceDTO::fromArray($request->validated());
        $invoice = $this->salesInvoiceService->create($dto);
        return response()->json($invoice, 201);
    }

}
