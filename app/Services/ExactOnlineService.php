<?php

namespace App\Services;

use App\Models\SalesInvoice;
use Illuminate\Support\Facades\Log;

class ExactOnlineService
{
    /**
     * @param SalesInvoice $invoice
     * @return void
     */
    public function sendInvoiceToExact(SalesInvoice $invoice): void
    {
        $payload = [
            'OrderedBy' => $invoice->ordered_by,
            'InvoiceTo' => $invoice->invoice_to ?? $invoice->ordered_by,
            'Journal' => $invoice->journal,
            'InvoiceDate' => $invoice->invoice_date,
            'Description' => $invoice->description,
            'SalesInvoiceLines' => $invoice->lines->map(function ($line) {
                return [
                    'Item' => $line->item_id,
                    'Quantity' => $line->quantity,
                    'UnitPrice' => $line->unit_price,
                    'Description' => $line->description,
                ];
            })->toArray(),
        ];

        Log::info('Forwarding to exact online service', $payload);
    }
}
