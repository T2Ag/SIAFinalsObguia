<?php

namespace Database\Seeders;

use App\Models\Membership;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MembershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mem = [
            [
                'type' => 'Pay-as-You-Go',
                'price' => 50
            ],
            [
                'type' => 'Monthly',
                'price' => 500
            ],
            [
                'type' => 'Yearly',
                'price' => 5000
            ],
        ];

        foreach($mem as $m) Membership::create($m);
    }
}
