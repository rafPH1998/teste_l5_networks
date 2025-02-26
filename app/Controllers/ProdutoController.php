<?php

namespace App\Controllers;

use App\Models\ProdutoModel;
use App\Validation\ProdutoStoreValidation;
use CodeIgniter\API\ResponseTrait;

class ProdutoController extends BaseController
{
    use ResponseTrait;
    
    protected $model;

    public function __construct()
    {
        $this->model = new ProdutoModel();
    }

    public function index()
    {
        $nome         = $this->request->getGet('nome');
        $descricao    = $this->request->getGet('descricao');

        if ($nome) {
            $this->model->like('nome', $nome);
        }

        if ($descricao) {
            $this->model->like('descricao', $descricao);
        }

        return $this->respond([
            'cabecalho' => ['status' => 200, 'mensagem' => 'Dados retornados com sucesso'],
            'retorno' => $this->model->findAll()
        ]);
    }

    public function show(int $id)
    {
        $data = $this->model->find($id);

        if (!$data) {
            return $this->failNotFound('Produto não encontrado :/');
        }

        return $this->respond([
            'cabecalho' => ['status' => 200, 'mensagem' => 'Dados retornados com sucesso'],
            'retorno' => $data
        ]);
    }
    
    public function store()
    {
        $contentType = $this->request->getHeaderLine('Content-Type');
        
        if (strpos($contentType, 'application/json') !== false) {
            $data = $this->request->getJSON(true);
        } else {
            $data = $this->request->getPost();
        }
        
        if (!$this->validate(ProdutoStoreValidation::rules(), ProdutoStoreValidation::messages())) {
            return $this->failValidationErrors($this->validator->getErrors());
        }
    
        if (!$this->model->insert($data)) {
            return $this->failValidationErrors($this->model->errors());
        }
    
        return $this->respond([
            'cabecalho' => ['status' => 201, 'mensagem' => 'Dados criados com sucesso'],
            'retorno' => $data
        ]);
    }

    public function update(int $id)
    {
        $data = $this->request->getJSON(true);

        if (!$this->model->find($id)) {
            return $this->failNotFound('Produto não encontrado.');
        }

        if (!$this->model->update($id, $data)) {
            return $this->failValidationErrors($this->model->errors());
        }

        return $this->respond([
            'cabecalho' => ['status' => 200, 'mensagem' => 'Dados atualizados com sucesso'],
            'retorno' => $data
        ]);
    }

    public function destroy(int $id)
    {
        if (!$this->model->find($id)) {
            return $this->failNotFound('Produto não encontrado.');
        }

        $this->model->delete($id);

        return $this->respond([
            'cabecalho' => ['status' => 204, 'mensagem' => 'Produto deletado com sucesso'],
            'retorno' => []
        ]);
    }
}

