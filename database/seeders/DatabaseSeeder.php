<?php

namespace Database\Seeders;

use App\Models\Ajuste;
use App\Models\Categoria;
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
        Role::create(['name' => 'SUPER ADMIN']);
        Role::create(['name' => 'ADMINISTRADOR']);
        Role::create(['name' => 'VENDEDOR']);
        Role::create(['name' => 'CLIENTE']);
        Role::create(['name' => 'CONTABILIDAD']);
        Role::create(['name' => 'OPERADOR']);

        User::create([
            'name' => 'Juan Carlos',
            'email' => 'admin@admin.com',
            'password' => bcrypt('12345678'),
        ])->assignRole('SUPER ADMIN');

        Ajuste::create([
            'nombre' => 'MarketVista',
            'descripcion' => 'Tienda Virtual de productos variados',
            'sucursal' => 'Matriz',
            'direccion' => 'Calle 123',
            'telefono' => '123456789',
            'email' => 'admin@admin.com',
            'logo' => 'logos/4mgzd1Qrql1Pws8MGxvLajbtWDIAoc4xZg9QmEEC.png',
            'imagen_login' => 'imagenes_login/G9tqWXNQSBewHmohDGU6DpdQTeL1Tn0AV1CdoaTW.webp',
            'divisa' => 'S/.',
            'pagina_web' => 'https://marketvista.com',
        ]);

        Categoria::factory(13)->create();



    }
}
