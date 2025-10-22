<?php

namespace Database\Seeders;

use App\Models\Ajuste;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('12345678'),
        ]);

        Ajuste::create([
            'nombre' => 'MarketVista',
            'descripcion' => 'Tienda Virtual de productos variados',
            'sucursal' => 'Matriz',
            'direccion' => 'Calle 123',
            'telefono' => '123456789',
            'email' => 'admin@admin.com',
            'logo' => 'logos/weqcDN2wKSLGAyMVuxdOyrRCFbUtH3QrnnMR6Cff.jpg',
            'imagen_login' => 'imagenes_login/EzTEYvqq9DhFF1H2WroNS7Wj9VL4w7f60fpBio3Q.jpg',
            'divisa' => 'S/.',
            'pagina_web' => 'https://marketvista.com',
        ]);

        Role::create(['name' => 'SUPER ADMIN']);
        Role::create(['name' => 'ADMINISTRADOR']);
        Role::create(['name' => 'VENDEDOR']);
        Role::create(['name' => 'CLIENTE']);
        Role::create(['name' => 'CONTABILIDAD']);
        Role::create(['name' => 'OPERADOR']);

    }
}
