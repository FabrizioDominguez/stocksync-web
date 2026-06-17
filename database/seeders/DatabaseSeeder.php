<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Insertar Roles
        DB::table('roles')->insert([
            ['name' => 'Administrador', 'description' => 'Control total del sistema e inventario'],
            ['name' => 'Vendedor', 'description' => 'Acceso a visualización de stock y registro de salidas']
        ]);

        // 2. Insertar Usuario Administrador (Contraseña encriptada con Bcrypt)
        DB::table('users')->insert([
            'role_id' => 1,
            'name' => 'Admin Tienda',
            'email' => 'admin@softmat.com.bo',
            'password' => Hash::make('password123'),
        ]);

        // 3. Insertar Categorías
        DB::table('categories')->insert([
            ['name' => 'Laptops', 'description' => 'Computadoras portátiles para hogar y oficina'],
            ['name' => 'Componentes PC', 'description' => 'Hardware interno: procesadores, memorias, tarjetas madre'],
            ['name' => 'Periféricos', 'description' => 'Teclados, mouses, auriculares y accesorios'],
            ['name' => 'Redes', 'description' => 'Routers, switches y antenas Wi-Fi'],
            ['name' => 'Monitores', 'description' => 'Pantallas para PC y diseño gráfico']
        ]);

        // 4. Insertar Productos de tu SQL original
        DB::table('products')->insert([
            ['category_id' => 1, 'barcode' => 'LT-ASU-001', 'name' => 'Laptop ASUS VivoBook 15', 'technical_specs' => 'Pantalla 15.6 FHD, Procesador Intel Core i5-1235U, 8GB RAM DDR4, 512GB SSD NVMe, Windows 11 Home.', 'price' => 4850.00, 'stock' => 12, 'min_stock' => 3],
            ['category_id' => 2, 'barcode' => 'SSD-KNG-500', 'name' => 'Disco Sólido M.2 Kingston NV2 500GB', 'technical_specs' => 'Capacidad 500GB, Factor de forma M.2 2280, Interfaz PCIe 4.0 x4 NVMe, Velocidad de lectura hasta 3500 MB/s.', 'price' => 320.00, 'stock' => 45, 'min_stock' => 10],
            ['category_id' => 3, 'barcode' => 'KB-RZS-099', 'name' => 'Teclado Mecánico Razer Huntsman Mini', 'technical_specs' => 'Formato 60%, Switches ópticos lineales Razer, Iluminación Chroma RGB, Cable USB-C desmontable.', 'price' => 950.00, 'stock' => 4, 'min_stock' => 5],
            ['category_id' => 4, 'barcode' => 'RT-TPL-C6', 'name' => 'Router TP-Link Archer C6 V3', 'technical_specs' => 'Wi-Fi AC1200 Doble Banda, 4 antenas externas, 1 puerto WAN Gigabit, 4 puertos LAN Gigabit, Soporte MU-MIMO.', 'price' => 315.00, 'stock' => 18, 'min_stock' => 5],
            ['category_id' => 5, 'barcode' => 'MN-LG-24MP', 'name' => 'Monitor LG 24" IPS FHD', 'technical_specs' => 'Panel IPS de 24 pulgadas, Resolución 1920x1080, Frecuencia 75Hz, AMD FreeSync, Puertos HDMI y VGA.', 'price' => 1100.00, 'stock' => 8, 'min_stock' => 4]
        ]);
    }
}