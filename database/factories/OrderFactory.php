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
        $destination = $this->faker->address();
        $latLng=Geocoding::getLatLng($destination);
        $products = $this->defineProducts();
        return array_merge([
            "buyer_name" => $this->faker->name(),
            "buyer_phone" => $this->faker->phoneNumber() ,
            "destination" => $destination ,
            "lat" => $latLng["lat"] ,
            "lng" => $latLng["lng"]
        ],compact('products'));
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
                'code' => $this->faker->randomNumber(),
            ];
        }

        return json_encode($products) ;

    }
}
