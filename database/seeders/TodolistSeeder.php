<?php

namespace Database\Seeders;

use App\Models\Todolist;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TodolistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Todolist::insert([
            [
                'title' => 'Belajar Laravel RestAPI Register',
                'description' => 'Belajar Laravel 12 RestAPI Sanctum & Logging',
                'is_done' => false
            ],
            [
                'title' => 'Belajar Laravel RestAPI CRUD With Api Resource',
                'description' => 'Belajar Laravel 12 RestAPI Crud With Resorce',
                'is_done' => false
            ],
            [
                'title' => 'Belajar Laravel RestAPI Login With Api Resource',
                'description' => 'Belajar Laravel 12 RestAPI Crud With Resorce login',
                'is_done' => true
            ],
        ]);
    }
}
