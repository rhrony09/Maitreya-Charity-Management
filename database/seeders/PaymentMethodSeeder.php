<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentMethodSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('payment_methods')->insert([
            'name' => 'Bkash',
            'created_at' => now(),
        ]);
        DB::table('payment_methods')->insert([
            'name' => 'Rocket',
            'created_at' => now(),
        ]);
        DB::table('payment_methods')->insert([
            'name' => 'Nagad',
            'created_at' => now(),
        ]);
        DB::table('payment_methods')->insert([
            'name' => 'Cash',
            'created_at' => now(),
        ]);
        DB::table('payment_methods')->insert([
            'name' => 'Bank',
            'created_at' => now(),
        ]);
    }
}
