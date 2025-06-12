<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
            User::factory()->create([
            'name' => 'Admin',
            'email' => 'amazing@boss.com', //   اي اسم غريب علشان محدش يعرف ايميل الادمنب  
            'role'=>'admin',
            'password' =>Hash::make(12345678)
        ]);

            User::factory()->create([
            'name' => 'Editor',
            'email' => 'editor@boss.com',  
            'role'=>'editor',
            'password' =>Hash::make(12345678)
        ]);
        
    }
}
