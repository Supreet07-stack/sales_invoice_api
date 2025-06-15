<?php

namespace Database\Factories;

use App\Models\SalesInvoice;
use App\Models\SalesInvoiceLine;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SalesInvoiceLine>
 */
class SalesInvoiceLineFactory extends Factory
{
    protected $model = SalesInvoiceLine::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
       return [
           'sales_invoice_id' => SalesInvoice::factory(),
           'item_id' => $this->faker->uuid(),
           'description' => $this->faker->words(3, true),
           'quantity' => $this->faker->numberBetween(1, 10),
           'unit_price' => $this->faker->randomFloat(2, 10, 1000),
       ];
    }

}

