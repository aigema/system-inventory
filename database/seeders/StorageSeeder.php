<?php

namespace Database\Seeders;

use App\Models\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StorageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Storage::create([
            'name' => 'GUDANG MALANG',
            'address' => 'Jl. Teluk Mandar, Kota Malang'
        ]);

        Storage::create([
            'name' => 'GUDANG SIDOARJO',
            'address' => 'Jl. Pahlawan, Kota Sidoarjo'
        ]);

        Storage::create([
            'name' => 'GUDANG BULUNGAN',
            'address' => 'Jl. Khatulistiwa, Kota Bulungan'
        ]);
    }
}
