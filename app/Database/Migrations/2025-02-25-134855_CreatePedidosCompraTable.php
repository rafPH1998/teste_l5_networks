<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePedidosCompraTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'cliente_id' => [
                'type' => 'BIGINT',
                'unsigned' => true,
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['Em Aberto', 'Pago', 'Cancelado'],
                'default' => 'Em Aberto',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => false,  
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => false,
                'on_update' => 'CURRENT_TIMESTAMP', 
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('cliente_id', 'clientes', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pedidos_compra');
    }

    public function down()
    {
        $this->forge->dropTable('pedidos_compra');
    }
}
