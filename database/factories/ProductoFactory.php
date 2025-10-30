<?php

namespace Database\Factories;

use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory
{
    public function definition(): array
    {
        // 🔹 Precios base para cálculos realistas
        $precioCompra = $this->faker->randomFloat(2, 10, 500);
        $margenGanancia = $this->faker->randomElement([0.15, 0.20, 0.25, 0.30, 0.35, 0.40]); // 15% - 40%
        $precioVenta = $precioCompra * (1 + $margenGanancia);

        // 🔹 Generar código único tipo PROD-XXXX
        $codigo = 'PROD-' . $this->faker->unique()->numberBetween(1000, 9999);

        // 🔹 Nombres de productos realistas por categoría
        $nombresElectronica = [
            'Smartphone Samsung Galaxy', 'Laptop Dell Inspiron', 'Tablet iPad Air',
            'Smart TV 55" 4K', 'Auriculares Inalámbricos', 'Smartwatch Apple',
            'Cámara DSLR Canon', 'Altavoz Bluetooth JBL', 'Monitor Gaming 27"',
            'Teclado Mecánico RGB', 'Mouse Inalámbrico', 'Impresora Multifuncional'
        ];

        $nombresRopa = [
            'Camiseta Básica Algodón', 'Jeans Slim Fit', 'Sudadera con Capucha',
            'Zapatos Deportivos Running', 'Chaqueta Denim', 'Vestido Casual',
            'Polo Clásico', 'Shorts Deportivos', 'Chamarra de Cuero',
            'Falda Plisada', 'Blusa Elegante', 'Traje Formal'
        ];

        $nombresHogar = [
            'Juego de Sábanas King', 'Cafetera Programable', 'Licuadora de 8 Velocidades',
            'Aspiradora Robot', 'Juego de Ollas Antiadherente', 'Microondas Digital',
            'Batidora de Mano', 'Tostador de 4 Ranuras', 'Jarra Eléctrica',
            'Set de Cubertería Acero', 'Olla de Cocción Lenta', 'Freidora de Aire'
        ];

        $nombresDeportes = [
            'Pelota de Fútbol Profesional', 'Raqueta de Tenis', 'Bicicleta de Montaña',
            'Zapatillas Deportivas Nike', 'Colchoneta Yoga', 'Cinta para Correr',
            'Set de Golf', 'Balón de Baloncesto', 'Pesas Rusas',
            'Cuerda para Saltar', 'Bandas de Resistencia', 'Reloj Deportivo'
        ];

        // 🔹 Unir todos los nombres
        $todosNombres = array_merge(
            $nombresElectronica,
            $nombresRopa,
            $nombresHogar,
            $nombresDeportes
        );

        // 🔹 Generar nombre final del producto
        $nombre = $this->faker->randomElement($todosNombres) . ' ' .
                  $this->faker->randomElement(['Pro', 'Max', 'Plus', 'Elite', 'Premium', 'Standard']);

        return [
            'categoria_id' => Categoria::inRandomOrder()->first()->id ?? Categoria::factory()->create()->id,
            'nombre' => $nombre,
            'codigo' => $codigo,
            'descripcion_corta' => $this->faker->sentence(8),
            'descripcion_larga' => $this->faker->paragraphs(3, true),
            'precio_compra' => $precioCompra,
            'precio_venta' => round($precioVenta, 2),
            'stock' => $this->faker->numberBetween(0, 100),
        ];
    }
}
