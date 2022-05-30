<?php

namespace Database\Seeders;

use App\Models\Logo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        $this->call(UserSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(SettingsSeeder::class);
        $this->call(PaymentMethodSeeder::class);
        $this->call(MonthSeeder::class);
    }
}
