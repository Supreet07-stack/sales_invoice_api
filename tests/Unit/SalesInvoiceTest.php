<?php

use App\DTOs\SalesInvoiceDTO;
use App\Models\SalesInvoiceLine;
use App\Services\SalesInvoiceService;
use App\Http\Repositories\SalesInvoiceRepository;
use App\Services\ExactOnlineService;
use App\Models\SalesInvoice;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;

uses(RefreshDatabase::class);

it('creates invoice and forwards to ExactOnlineService', function () {
    $repo = new SalesInvoiceRepository();

    $mockExactService = Mockery::mock(ExactOnlineService::class);
    $mockExactService
        ->shouldReceive('sendInvoiceToExact')
        ->once()
        ->with(Mockery::type(SalesInvoice::class));

    $service = new SalesInvoiceService($repo, $mockExactService);

    $invoiceData = SalesInvoice::factory()->make()->toArray();

    $invoiceData['sales_invoice_lines'] = [
       SalesInvoiceLine::factory()->make([
            'sales_invoice_id' => null
        ])->toArray()
    ];

    $invoiceDto = SalesInvoiceDTO::fromArray($invoiceData);

    $invoice = $service->create($invoiceDto);

    expect($invoice)->toBeInstanceOf(SalesInvoice::class)
        ->and($invoice->lines)->toHaveCount(1);
});
