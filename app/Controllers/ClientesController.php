<?php

namespace App\Controllers;

use App\Models\ClienteModel;
use App\Validation\ClienteStoreValidation;
use CodeIgniter\API\ResponseTrait;

class ClientesController extends BaseController
{
    use ResponseTrait;
    
    protected $model;

    public function __construct()
    {
        $this->model = new ClienteModel();
    }

    public function index()
    {
        $cpfCnpj         = $this->request->getGet('cpf_cnpj');
        $nomeRazaoSocial = $this->request->getGet('nome_razao_social');

        if ($cpfCnpj) {
            $this->model->where('cpf_cnpj', $cpfCnpj);
        }

        if ($nomeRazaoSocial) {
            $this->model->like('nome_razao_social', $nomeRazaoSocial);
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
            return $this->failNotFound('Cliente não encontrado :/');
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
        
        if (!$this->validate(ClienteStoreValidation::rules(), ClienteStoreValidation::messages())) {
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
            return $this->failNotFound('Cliente não encontrado.');
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
            return $this->failNotFound('Cliente não encontrado.');
        }

        $this->model->delete($id);

        return $this->respond([
            'cabecalho' => ['status' => 204, 'mensagem' => 'Dado deletado com sucesso'],
            'retorno' => []
        ]);
    }
}
