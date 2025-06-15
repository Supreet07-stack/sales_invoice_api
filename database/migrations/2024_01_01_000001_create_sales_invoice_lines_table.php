<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if(!Schema::hasTable('sales_invoice_lines')) {
            Schema::create('sales_invoice_lines', function (Blueprint $table) {
                $table->id();
                $table->foreignId('sales_invoice_id')->constrained()->onDelete('cascade');
                $table->uuid('item_id');
                $table->string('description')->nullable();
                $table->integer('quantity');
                $table->decimal('unit_price', 10, 2)->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        }

    }

    public function down(): void
    {
        if(Schema::hasTable('sales_invoice_lines')) {
            Schema::dropIfExists('sales_invoice_lines');
        }
    }
};
