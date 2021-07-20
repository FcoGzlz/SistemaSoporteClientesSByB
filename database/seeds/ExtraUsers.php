<?php

use App\User;
use Illuminate\Database\Seeder;

class ExtraUsers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $diego = User::create([
            'nombre' => 'Diego Alexander',
            'apellido' => 'Mora López',
            'email' => 'diego.mora@gmail.com',
            'password' => bcrypt('Diego.Mora.123')
        ]);

        $diego->assignRole('UOperativo');

        $pedro = User::create([
            'nombre' => 'Pedro Antonio',
            'apellido' => 'Paredez Almonocid',
            'email' => 'pedro.almonacid@gmail.com',
            'password' => bcrypt('Pedro.Almonacid.123')
        ]);

        $pedro->assignRole('UOperativo');

        $cristian = User::create([
            'nombre' => 'Cristian Andrés',
            'apellido' => 'Torres Gutiérrez',
            'email' => 'cristian.torres@gmail.com',
            'password' => bcrypt('Ctristian.Torres.123')
        ]);

        $cristian->assignRole('UOperativo');
    }
}
