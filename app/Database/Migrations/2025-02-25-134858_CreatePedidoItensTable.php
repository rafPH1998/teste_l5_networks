<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePedidoItensTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'pedido_id' => [
                'type' => 'BIGINT',
                'unsigned' => true,
            ],
            'produto_id' => [
                'type' => 'BIGINT',
                'unsigned' => true,
            ],
            'quantidade' => [
                'type' => 'INT',
                'default' => 1,
            ],
            'preco' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
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
        $this->forge->addForeignKey('pedido_id', 'pedidos_compra', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('produto_id', 'produtos', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pedido_itens');
    }

    public function down()
    {
        $this->forge->dropTable('pedido_itens');
    }
}
