<?php

namespace App\Validation;

class PedidoCompraStoreValidation
{
    public static function rules(): array
    {
        return [
            'cliente_id' => 'required|integer|is_not_unique[clientes.id]',
            'itens.*.produto_id' => 'required|integer|is_not_unique[produtos.id]',
            'status' => 'required|in_list[Em Aberto,Pago,Cancelado]',
            'itens' => 'required',
        ];
    }

    public static function messages(): array
    {
        return [
            'cliente_id' => [
                'required' => 'O campo cliente é obrigatório',
                'integer' => 'O ID do cliente deve ser um número inteiro',
                'is_not_unique' => 'O cliente selecionado não existe'
            ],
            'status' => [
                'required' => 'O status do pedido é obrigatório',
                'in_list' => 'O status deve ser Em Aberto, Pago ou Cancelado'
            ],
            'itens' => [
                'required' => 'O pedido deve ter pelo menos um item',
            ],
            'itens.*.produto_id' => [
                'required' => 'O produto é obrigatório para cada item',
                'integer' => 'O ID do produto deve ser um número inteiro',
                'is_not_unique' => 'O produto selecionado não existe'
            ],
            'itens.*.quantidade' => [
                'required' => 'A quantidade é obrigatória para cada item',
                'integer' => 'A quantidade deve ser um número inteiro',
                'greater_than' => 'A quantidade deve ser maior que zero'
            ],
            'itens.*.preco' => [
                'required' => 'O preço é obrigatório para cada item',
                'numeric' => 'O preço deve ser um valor numérico',
                'greater_than' => 'O preço deve ser maior que zero'
            ]
        ];
    }

}
