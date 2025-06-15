<?php

namespace Database\Factories;

use App\Models\SalesInvoice;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SalesInvoice>
 */
class SalesInvoiceFactory extends Factory
{
    protected $model = SalesInvoice::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ordered_by' => Str::uuid(),
            'invoice_to' => Str::uuid(),
            'journal' => $this->faker->randomElement(['40', '50', '60', '70', '80', '90', '100']),
            'invoice_date' => $this->faker->date(),
            'description' => $this->faker->sentence(),
        ];
    }
}
