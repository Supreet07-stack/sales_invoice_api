<?php

namespace App\Http\Repositories;

use App\DTOs\SalesInvoiceDTO;
use App\Models\SalesInvoice;
use Illuminate\Support\Facades\DB;

class SalesInvoiceRepository
{
    /**
     * @param SalesInvoiceDTO $data
     * @return SalesInvoice
     */
    public function createInvoiceWithLines(SalesInvoiceDTO $data): SalesInvoice
    {
        return DB::transaction(function () use ($data) {
            $invoice = SalesInvoice::create([
                'ordered_by' => $data->ordered_by,
                'invoice_to' => $data->invoice_to ?? null,
                'journal'  => $data->journal,
                'invoice_date' => $data->invoice_date ?? now(),
                'description' => $data->description ?? null,
            ]);

            foreach ($data->sales_invoice_lines as $line) {
                $invoice->lines()->create([
                    'item_id' => $line['item_id'],
                    'quantity' => $line['quantity'],
                    'unit_price' => $line['unit_price'] ?? null,
                    'description' => $line['description'] ?? null,
                ]);
            }

            return $invoice;
        });
    }

}

