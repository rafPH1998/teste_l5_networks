<?php

namespace App\Models;

use CodeIgniter\Model;

class PedidoItemModel extends Model
{
    protected $table = 'pedido_itens';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['pedido_id', 'produto_id', 'quantidade', 'preco', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function pedidoCompra()
    {
        return $this->belongsTo('App\Models\PedidoCompraModel', 'pedido_id', 'id');
    }

    public function produto()
    {
        return $this->belongsTo('App\Models\ProdutoModel', 'produto_id', 'id');
    }
}
