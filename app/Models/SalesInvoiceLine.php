<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalesInvoiceLine extends Model
{
    use SoftDeletes,HasFactory;
    protected $fillable = ['sales_invoice_id','item_id','description', 'quantity', 'unit_price'];

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(SalesInvoice::class);
    }
}
