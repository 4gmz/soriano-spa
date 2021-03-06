<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            DB::table('users')->insert([
                [
                    'nombre_completo' => 'Juan Gómez',
                    'email' => 'go1.juangomez23@gmail.com',
                    'telefono' => '+573188315485',
                    'rol_id' => 1,
                    'foto'=> null,
                    'password' => bcrypt('password')
                ]
            ]);
    }
}
