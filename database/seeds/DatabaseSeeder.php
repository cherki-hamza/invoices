<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Str::random(10)
        // $this->call(UsersTableSeeder::class);

        // create two users ************************//
        DB::table('users')->insert([
            'name' => 'cherki hamza',
            'email' => 'cherki0hamza@gmail.com',
            'password' => Hash::make('123456789'),
        ]);
        DB::table('users')->insert([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => Hash::make('123456789'),
        ]);
        //*********************************************//

        //****************** get the users *************************//
         $all_users = DB::table('users')->pluck('id');
        //**********************************************************//
         // create two sections ************************//
        DB::table('sections')->insert([
            'section_name' => 'CIH',
            'description' => 'desc for cih',
            'created_by' => $all_users->random(),
        ]);
        DB::table('sections')->insert([
            'section_name' => 'BMCE',
            'description' => 'desc for bmce',
            'created_by' => $all_users->random(),
        ]);
        //*********************************************//

         //****************** get the sections *************//
         $all_sections = DB::table('sections')->pluck('id');
         //*************************************************//

        // create products ************************//
        DB::table('products')->insert([
            'product_name' => 'echeping cart',
            'description' => 'desc for cih echeping',
            'section_id' => $all_sections->random(),
        ]);
        DB::table('products')->insert([
            'product_name' => 'cih jeune maroc',
            'description' => 'desc for cih jeune maroc',
            'section_id' => $all_sections->random(),
        ]);
        DB::table('products')->insert([
            'product_name' => 'product 1 bmce ',
            'description' => 'desc for product 1 bmce',
            'section_id' => $all_sections->random(),
        ]);
        DB::table('products')->insert([
            'product_name' => 'product 2 bmce',
            'description' => 'desc for product 2 bmce',
            'section_id' => $all_sections->random(),
        ]);
        //*********************************************//

       




    }
}
