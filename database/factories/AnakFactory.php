<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Pegawai;

class AnakFactory extends Factory
{
    protected $model = \App\Models\Anak::class;

    public function definition()
    {
        $pegawaiIds = Pegawai::pluck('id')->toArray();

        return [
            'pegawais_id' => $this->faker->randomElement($pegawaiIds),
            'nama' => $this->faker->name(),
            'tgl_lahir' => $this->faker->date(),
            'tempat_lahir' => $this->faker->city(),
            'status_pekerjaan' => $this->faker->randomElement(['bekerja', 'belum bekerja']),
            'status_pernikahan' => $this->faker->randomElement(['menikah', 'belum menikah']),
            'pendidikan' => $this->faker->randomElement(['SD', 'SMP', 'SMA', 'Diploma', 'Sarjana']),
            'nama_sekolah' => $this->faker->company(),
        ];
    }
}
