<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('settings')->insert([
            'type' => 'logo',
            'name' => 'logo.png',
            'created_at' => Carbon::now(),
        ]);
        DB::table('settings')->insert([
            'type' => 'logo_black',
            'name' => 'logo-black.png',
            'created_at' => Carbon::now(),
        ]);
        DB::table('settings')->insert([
            'type' => 'favicon',
            'name' => 'favicon.png',
            'created_at' => Carbon::now(),
        ]);
        DB::table('settings')->insert([
            'type' => 'title',
            'name' => 'মৈত্রেয়',
            'created_at' => Carbon::now(),
        ]);
        DB::table('settings')->insert([
            'type' => 'tagline',
            'name' => 'হাসি মুখের প্রত্যাশায়',
            'created_at' => Carbon::now(),
        ]);
        DB::table('settings')->insert([
            'type' => 'contact',
            'name' => '01680710175',
            'created_at' => Carbon::now(),
        ]);
        DB::table('settings')->insert([
            'type' => 'email',
            'name' => 'info@maitreyabd.org',
            'created_at' => Carbon::now(),
        ]);
    }
}
