<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalesInvoice extends Model
{
    use SoftDeletes, HasFactory;
    protected $fillable = ['ordered_by','invoice_to','journal', 'invoice_date','description'];

    public function lines(): HasMany
    {
        return $this->hasMany(SalesInvoiceLine::class);
    }
}
