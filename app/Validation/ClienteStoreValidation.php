<?php

namespace App\Validation;

class ClienteStoreValidation
{
    public static function rules(): array
    {
        return [
            'cpf_cnpj' => 'required|is_unique[clientes.cpf_cnpj]|min_length[11]|max_length[20]',
            'nome_razao_social' => 'required|min_length[3]|max_length[255]',
        ];
    }

    public static function messages(): array
    {
        return [
            'cpf_cnpj' => [
                'required' => 'O campo CPF/CNPJ é obrigatório.',
                'is_unique' => 'Este CPF/CNPJ já está cadastrado.',
                'min_length' => 'O CPF/CNPJ deve ter pelo menos 11 caracteres.',
                'max_length' => 'O CPF/CNPJ pode ter no máximo 20 caracteres.',
            ],
            'nome_razao_social' => [
                'required' => 'O campo Nome/Razão Social é obrigatório.',
                'min_length' => 'O Nome/Razão Social deve ter pelo menos 3 caracteres.',
                'max_length' => 'O Nome/Razão Social pode ter no máximo 255 caracteres.',
            ],
        ];
    }
}
