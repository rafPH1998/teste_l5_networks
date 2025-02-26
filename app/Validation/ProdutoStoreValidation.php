<?php

namespace App\Validation;

class ProdutoStoreValidation
{
    public static function rules(): array
    {
        return [
            'nome' => 'required|min_length[3]|max_length[255]',
            'descricao' => 'permit_empty|string',
            'preco' => 'required|numeric|greater_than[0]',
        ];
    }

    public static function messages(): array
    {
        return [
            'nome' => [
                'required' => 'O campo Nome é obrigatório.',
                'min_length' => 'O Nome deve ter pelo menos 3 caracteres.',
                'max_length' => 'O Nome pode ter no máximo 255 caracteres.',
            ],
            'descricao' => [
                'string' => 'A Descrição deve ser um texto válido.',
            ],
            'preco' => [
                'required' => 'O campo Preço é obrigatório.',
                'numeric' => 'O Preço deve ser um valor numérico.',
                'greater_than' => 'O Preço deve ser maior que zero.',
            ],
        ];
    }
}