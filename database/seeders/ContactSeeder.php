<?php

   namespace Database\Seeders;

   use Illuminate\Database\Seeder;
   use App\Models\Contact;

   class ContactSeeder extends Seeder
   {
       public function run(): void
       {
           Contact::create([
               'name' => 'João Silva',
               'contact' => '123456789',
               'email' => 'joao@example.com',
           ]);
           Contact::create([
               'name' => 'Maria Oliveira',
               'contact' => '987654321',
               'email' => 'maria@example.com',
           ]);
       }
   }
