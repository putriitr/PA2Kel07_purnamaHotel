<?php

namespace Database\Seeders;
use App\Models\Admin;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use PHPUnit\Event\Test\AfterTestMethodFinished;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = [
            ['id'=>1, 'name'=>'Hasan Sinaga', 'email'=>'sinagahasan17@gmail.com', 'password'=>'$2a$12$/u9JjWV/IUCWU2UEnv/n2enjMo7a0bJXpYGDQXoFiNv/otFr.frYW'],
        ];
        Admin::insert($admin);
    }
}
