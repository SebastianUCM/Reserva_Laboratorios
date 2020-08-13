<?php

use Illuminate\Database\Seeder;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Sebastian Fuenzalida',
            'email' => 's@gmail.com',
            'password' => bcrypt('123'),
            'rol' => 'Secretario/a',
        ]);
    }
}
