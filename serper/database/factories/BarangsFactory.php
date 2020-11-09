<?php

namespace Database\Factories;

use App\Models\Barangs;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BarangsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Barangs::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'kode' => $this->faker->sentence,
            'nama' => $this->faker->sentence,
            'merk' => $this->faker->sentence,
            'kategori' => $this->faker->sentence,
            'partnumber1' => $this->faker->sentence,
            'partnumber2' => $this->faker->sentence,
            'kendaraan' => $this->faker->sentence, 
            'kdsupplier'=> $this->faker->sentence,
            'dimensi'=> $this->faker->sentence,
            'aktif'=> $this->faker->sentence,
            'created_by'=> rand(1, 10)
        ];
    }
}
