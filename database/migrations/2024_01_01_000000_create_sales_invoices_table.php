<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if(!Schema::hasTable('sales_invoices')){
            Schema::create('sales_invoices', function (Blueprint $table) {
            $table->id();
            $table->uuid('ordered_by');
            $table->uuid('invoice_to')->nullable(); //optional ; falls back to ordered_by
            $table->string('journal');
            $table->date('invoice_date')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        }

    }

    public function down(): void
    {
       if(Schema::hasTable('sales_invoices')){
           Schema::dropIfExists('sales_invoices');
       }
    }
};
