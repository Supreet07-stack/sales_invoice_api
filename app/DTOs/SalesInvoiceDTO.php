<?php

namespace App\DTOs;

class SalesInvoiceDTO
{
    public function __construct(
        public string $ordered_by,
        public ?string $invoice_to,
        public string $journal,
        public ?string $invoice_date,
        public ?string $description,
        public array $sales_invoice_lines
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            $data['ordered_by'],
            $data['invoice_to'] ?? null,
            $data['journal'],
            $data['invoice_date'] ?? null,
            $data['description'] ?? null,
            $data['sales_invoice_lines']
        );
    }
}
