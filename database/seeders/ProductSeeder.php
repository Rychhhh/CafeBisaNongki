<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $product = [
            [
                'nama_menu' => 'Kopi',
                'harga' => 15000,
                'desc' => 'Kopi Enak Mantap',
                'stok' => 125,
                'photo' => 'kopi.png',
            ],
            [
                'nama_menu' => 'Kopi',
                'harga' => 15000,
                'desc' => 'Kopi Enak Mantap',
                'stok' => 125,
                'photo' => 'kopi.png',
            ],
            [
                'nama_menu' => 'Kopi',
                'harga' => 15000,
                'desc' => 'Kopi Enak Mantap',
                'stok' => 125,
                'photo' => 'kopi.png',
            ],
            [
                'nama_menu' => 'Pisang Goreng',
                'harga' => 19000,
                'desc' => 'Pisang Enak Mantap',
                'stok' => 55,
                'photo' => 'pisang-goreng.jpg',
            ],
            [
                'nama_menu' => 'Pisang Goreng',
                'harga' => 19000,
                'desc' => 'Pisang Enak Mantap',
                'stok' => 55,
                'photo' => 'pisang-goreng.jpg',
            ],
            [
                'nama_menu' => 'Pisang Goreng',
                'harga' => 19000,
                'desc' => 'Pisang Enak Mantap',
                'stok' => 55,
                'photo' => 'pisang-goreng.jpg',
            ],
            [
                'nama_menu' => 'Piscok',
                'harga' => 25000,
                'desc' => 'Piscok Enak Mantap',
                'stok' => 425,
                'photo' => 'piscok.jpg',
            ],
            [
                'nama_menu' => 'Piscok',
                'harga' => 25000,
                'desc' => 'Piscok Enak Mantap',
                'stok' => 425,
                'photo' => 'piscok.jpg',
            ],
            [
                'nama_menu' => 'Piscok',
                'harga' => 25000,
                'desc' => 'Piscok Enak Mantap',
                'stok' => 425,
                'photo' => 'piscok.jpg',
            ],
        ];

        foreach($product as $key => $value) {
            Menu::insert($value);
        }
    }
}
