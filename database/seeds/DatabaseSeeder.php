<?php

use Illuminate\Database\Seeder;
use App\Question;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        factory(App\User::class,3)->create()->each(function($cadaUsuario){
            $cadaUsuario->questions()
                ->saveMany(
                    factory(App\Question::class,5)->make()
                );
        });
        factory(App\Question::class,15)->create();

    }
}
