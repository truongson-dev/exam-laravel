<?php

namespace Database\Factories;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

class RestaurantFactory extends Factory
{
    protected $model = Restaurant::class;

    private array $comDia = [
        'Cơm Sườn Nướng',
        'Cơm Gà Chiên',
        'Cơm Bò Lúc Lắc',
        'Cơm Tấm Bì Chả',
        'Cơm Chiên Dương Châu',
    ];

    private array $banhMy = [
        'Bánh Mỳ Thịt Nướng',
        'Bánh Mỳ Pate',
        'Bánh Mỳ Trứng',
        'Bánh Mỳ Gà',
        'Bánh Mỳ Bò Kho',
    ];

    private array $buPho = [
        'Phở Bò Tái',
        'Phở Gà',
        'Bún Bò Huế',
        'Bún Riêu Cua',
        'Phở Bò Chín',
    ];

    public function definition(): array
    {
        $category = $this->faker->randomElement(Restaurant::categories());

        $name = match ($category) {
            'Cơm Dĩa' => $this->faker->randomElement($this->comDia),
            'Bánh mỳ' => $this->faker->randomElement($this->banhMy),
            'Bú phở' => $this->faker->randomElement($this->buPho),
        };

        return [
            'name' => $name,
            'category' => $category,
            'price' => $this->faker->randomElement([25000, 30000, 35000, 40000, 45000, 50000, 55000, 60000]),
            'description' => $this->faker->sentence(12),
            'image' => 'images/food-' . $this->faker->numberBetween(1, 5) . '.jpg',
            'status' => $this->faker->randomElement([1, 1, 1, 0]), // mostly available
        ];
    }
}