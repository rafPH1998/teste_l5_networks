<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdutoModel extends Model
{
    protected $table = 'produtos';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['nome', 'descricao', 'quantidade', 'preco', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function pedidoItens()
    {
        return $this->hasMany('App\Models\PedidoItemModel', 'produto_id', 'id');
    }

    public function getProduto(int $produtoId)
    {
        return $this->db->table('produtos')
            ->select('id, nome, quantidade')
            ->where('id', $produtoId)
            ->get()
            ->getRow();
    }

    public function atualizarEstoque(int $produtoId, int $quantidade)
    {
        $this->db->table('produtos')
            ->where('id', $produtoId)
            ->set('quantidade', 'quantidade - ' . $quantidade, false)
            ->update();
    }


}
