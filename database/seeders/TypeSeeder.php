<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
$type=[
    [
        'name'=>'Online',
    ],
    [
        'name'=>'Offline',
    ],[
        'name'=>'Both',
    ]
];

foreach ($type as $type) {
   Type::create($type);
}

    }
}
