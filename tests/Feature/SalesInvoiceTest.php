<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use App\Models\SalesInvoice;
use App\Models\SalesInvoiceLine;

uses(RefreshDatabase::class);

it('creates a sales invoice and logs forwarding', function () {
    Log::spy(); // Start spying on logs

    $invoiceData = SalesInvoice::factory()->make()->toArray();
    $lineData = SalesInvoiceLine::factory()->make([
        'sales_invoice_id' => null
    ])->toArray();

    $invoiceData['sales_invoice_lines'] = [$lineData];

    $response = $this->postJson('/api/sales-invoices', $invoiceData);

    $response->assertCreated();
    $this->assertDatabaseHas('sales_invoices', ['description' => $invoiceData['description']]);
    $invoiceId = $response->json('id');

    $this->assertDatabaseHas('sales_invoice_lines', [
        'sales_invoice_id' => $invoiceId,
        'item_id' => $lineData['item_id'],
    ]);

    Log::getFacadeRoot()
        ->shouldHaveReceived('info')
        ->once()
        ->with('Forwarding to exact online service', Mockery::type('array'));
});

it('fails validation if required fields are missing', function () {
    $response = $this->postJson('/api/sales-invoices', []);

    $response->assertStatus(422);
    $response->assertJsonValidationErrors([
        'ordered_by',
        'journal',
        'sales_invoice_lines'
    ]);
});
