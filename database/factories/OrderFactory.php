<?php

namespace Database\Factories;

use App\Facades\Geocoding;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $destination = $this->faker->address() . ',' . $this->faker->city();
//        $latLng=Geocoding::getLatLng($destination);
        $products = $this->defineProducts();
        return [
            "buyer_name" => $this->faker->name(),
            "buyer_phone" => $this->faker->phoneNumber(),
            "city" => $this->faker->city(),
            "destination" => $destination,
            "state" => $this->faker->state,
            "lng" => $this->faker->longitude(-124.733056, -66.951381),
            "lat" => $this->faker->latitude(40.396308, 47.384358),
            'products' => $products,
            "number" => $this->faker->numberBetween(),
            "street" => $this->faker->streetAddress(),
            "buyer_email" => $this->faker->email()
        ];
    }

    private function defineProducts()
    {
        $products = [];

        $numProducts = $this->faker->numberBetween(1, 5);
        for ($i = 0; $i < $numProducts; $i++) {
            $products[] = [
                'name' => $this->faker->word,
                'amount' => $this->faker->randomNumber(2),
                'price' => $this->faker->randomFloat(2, 5, 100),
                'code' => $this->faker->randomLetter(),
                "status" => "nonChecked"
            ];
        }

        return json_encode($products);

    }
}
