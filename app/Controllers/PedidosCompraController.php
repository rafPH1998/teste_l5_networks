<?php

namespace App\Controllers;

use App\Models\ClienteModel;
use App\Models\PedidoCompraModel;
use App\Models\PedidoItemModel;
use App\Models\ProdutoModel;
use App\Validation\PedidoCompraStoreValidation;
use CodeIgniter\API\ResponseTrait;

class PedidosCompraController extends BaseController
{
    use ResponseTrait;
    
    protected $model;
    protected $itemModel;
    protected $produtoModel;
    protected $clienteModel;

    public function __construct()
    {
        $this->model = new PedidoCompraModel();
        $this->itemModel = new PedidoItemModel();
        $this->produtoModel = new ProdutoModel();
        $this->clienteModel = new ClienteModel();
    }

    public function index()
    {
        $clienteId = $this->request->getGet('cliente_id');
        $status    = $this->request->getGet('status');
        $perPage   = $this->request->getGet('per_page') ?? 10;
    
        $query = $this->model
            ->select('pedidos_compra.*, clientes.nome_razao_social, clientes.cpf_cnpj')
            ->join('clientes', 'clientes.id = pedidos_compra.cliente_id');
    
        if ($clienteId) {
            $query->where('pedidos_compra.cliente_id', $clienteId);
        }
    
        if ($status) {
            $query->where('pedidos_compra.status', $status);
        }
    
        $pedidos = $query->paginate($perPage);
        $pager   = $this->model->pager;
    
        foreach ($pedidos as &$pedido) {
            $pedido['itens'] = $this->itemModel
                ->where('pedido_id', $pedido['id'])
                ->findAll();
    
            $pedido['cliente'] = [
                'id'                => $pedido['cliente_id'],
                'nome_razao_social' => $pedido['nome_razao_social'],
                'cpf_cnpj'          => $pedido['cpf_cnpj'],
            ];
    
            unset($pedido['cliente_id'], $pedido['nome_razao_social'], $pedido['cpf_cnpj']);
        }
    
        return $this->respond([
            'cabecalho' => ['status' => 200, 'mensagem' => 'Dados retornados com sucesso'],
            'pedidos'   => $pedidos,
            'paginacao' => [
                'current_page' => $pager->getCurrentPage(),
                'per_page'     => $pager->getPerPage(),
                'total'        => $pager->getTotal(),
                'last_page'    => $pager->getPageCount(),
                'next'         => $pager->getNextPageURI(),
                'previous'     => $pager->getPreviousPageURI(),
            ]
        ]);
    }
    
    public function show(int $id)
    {
        $pedido = $this->model->find($id);

        if (!$pedido) {
            return $this->failNotFound('Pedido não encontrado');
        }

        $pedido['itens'] = $this->itemModel->where('pedido_id', $id)->findAll();

        return $this->respond([
            'cabecalho' => ['status' => 200, 'mensagem' => 'Dados retornados com sucesso'],
            'retorno' => $pedido
        ]);
    }
    
    // aplicando transaction para garantir caso haja falha nao insira dados que nao estao completos
    public function store()
    {
        $contentType = $this->request->getHeaderLine('Content-Type');
        $data = strpos($contentType, 'application/json') !== false ? $this->request->getJSON(true) : $this->request->getPost();

        if (!$this->validate(PedidoCompraStoreValidation::rules(), PedidoCompraStoreValidation::messages())) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $itens = $data['itens'] ?? [];
        unset($data['itens']);

        $data['created_at'] = $data['updated_at'] = date('Y-m-d H:i:s');

        $db = \Config\Database::connect();
        $db->transBegin();

        try {
            foreach ($itens as &$item) {
                $produto = $this->produtoModel->getProduto($item['produto_id']);

                if (!$produto) {
                    throw new \Exception("O produto ID {$item['produto_id']} não existe.");
                }

                if ($item['quantidade'] > $produto->quantidade) {
                    throw new \Exception("Produto {$produto->nome} não tem a quantidade desejada. Disponível: {$produto->quantidade}.");
                }
            }
            unset($item);

            if (!$this->model->insert($data)) {
                throw new \Exception('Erro ao inserir o pedido.');
            }

            $pedidoId = $this->model->getInsertID();

            foreach ($itens as &$item) {
                $this->produtoModel->atualizarEstoque($item['produto_id'], $item['quantidade']);

                $item['pedido_id'] = $pedidoId;
                $item['created_at'] = $item['updated_at'] = date('Y-m-d H:i:s');
            }
            unset($item);

            $this->itemModel->insertBatch($itens);

            $db->transCommit();

            return $this->respond([
                'cabecalho' => ['status' => 201, 'mensagem' => 'Pedido criado com sucesso'],
                'retorno' => $this->model->find($pedidoId)
            ]);
        } catch (\Exception $e) {
            $db->transRollback();
            return $this->fail('Erro ao criar pedido: ' . $e->getMessage());
        }
    }

    public function destroy(int $id)
    {
        if (!$this->model->find($id)) {
            return $this->failNotFound('Pedido não encontrado');
        }

        $db = \Config\Database::connect();
        $db->transBegin();

        try {
            $this->itemModel->where('pedido_id', $id)->delete();
            $this->model->delete($id);

            if ($db->transStatus() === false) {
                throw new \Exception('Erro na transação');
            }

            $db->transCommit();
            
            return $this->respond([
                'cabecalho' => ['status' => 200, 'mensagem' => 'Pedido deletado com sucesso'],
                'retorno' => []
            ], 200);
        } catch (\Exception $e) {
            $db->transRollback();
            return $this->failServerError('Erro ao excluir pedido: ' . $e->getMessage());
        }
    }

    public function updateStatus(int $id)
    {
        $data = $this->request->getJSON(true);
        
        $pedido = $this->model->find($id);
        if (!$pedido) {
            return $this->failNotFound('Pedido não encontrado');
        }
        
        if (!$this->validate([
            'status' => 'required|in_list[Em Aberto,Pago,Cancelado]',
        ])) {
            return $this->failValidationErrors($this->validator->getErrors());
        }
        
        $this->model->update($id, [
            'status' => $data['status'],
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        
        $pedidoAtualizado = $this->model->find($id);
        $pedidoAtualizado['itens'] = $this->itemModel->where('pedido_id', $id)->findAll();
        
        return $this->respond([
            'cabecalho' => ['status' => 200, 'mensagem' => 'Status do pedido atualizado com sucesso'],
            'retorno' => $pedidoAtualizado
        ]);
    }
}