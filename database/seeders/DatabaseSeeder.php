<?php

   namespace Database\Seeders;

   use Illuminate\Database\Seeder;
   use App\Models\User;

   class DatabaseSeeder extends Seeder
   {
       public function run(): void
       {
           User::create([
               'name' => 'Admin User',
               'email' => 'admin@example.com',
               'password' => bcrypt('password123'),
           ]);

           $this->call(ContactSeeder::class);
       }
   }
