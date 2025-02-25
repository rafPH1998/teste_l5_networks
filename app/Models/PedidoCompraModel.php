<?php

namespace App\Models;

use CodeIgniter\Model;

class PedidoCompraModel extends Model
{
    protected $table = 'pedidos_compra';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['cliente_id', 'status', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

  
    public function cliente()
    {
        return $this->belongsTo('App\Models\ClienteModel', 'cliente_id', 'id');
    }

    public function pedidoItens()
    {
        return $this->hasMany('App\Models\PedidoItemModel', 'pedido_id', 'id');
    }
}
