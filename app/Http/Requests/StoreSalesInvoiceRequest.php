<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSalesInvoiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ordered_by' => 'required|uuid',
            'invoice_to' => 'nullable|uuid',
            'journal' => 'required|string',
            'invoice_date' => 'nullable|date',
            'description' => 'nullable|string',
            'sales_invoice_lines' => 'required|array|min:1',
            'sales_invoice_lines.*.item_id' => 'required|uuid',
            'sales_invoice_lines.*.description' => 'nullable|string',
            'sales_invoice_lines.*.quantity' => 'required|integer|min:1',
            'sales_invoice_lines.*.unit_price' => 'nullable|numeric|min:0',
        ];
    }
}
