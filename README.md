# L5 Networks

## Descrição Geral

O desafio consiste em implementar uma API REST utilizando o framework PHP
Codeigniter 4, e um banco de dados relacional MySQL.

---

## Requisitos de Instalação

Certifique-se de ter as seguintes ferramentas instaladas:

- **Docker**: v27.4.x
- **Docker Compose**: v1.29.x ( Caso estiver no windows )
- **PHP**: 8.1.x >
- **MySql**: 5.7.22.x >

## Instalação do PHP caso esteja no Ubuntu: 
```bash
sudo apt-get install php
```
---

## Instruções para Build do Projeto

Siga os passos abaixo para configurar e iniciar o projeto:

1. Clone Repositório:
   ```bash
   git clone https://github.com/rafPH1998/teste_l5_networks.git
   ```

2. Navegue até o projeto:
   ```bash
   cd teste_l5_networks
   ```

3. Execute o comando para obter o banco de dados rodando em sua máquina local:
   ```bash
   docker-compose up -d
   ```

4. Execute o comando para obter as tabelas do projeto:
```bash
php spark migrate
```

5. Execute o comando para rodar o servidor e ter acesso ao projeto:
  ```bash
  php -S localhost:8000 -t public
  ```
Após a execução dos comandos acima, acesse o projeto no seu navegador através do localhost:8000.

---
**Nota:** Não foi adicionado a autenticação, por tanto não é necessário passar o token para cada requisição.

## Rotas da aplicação para produtos


### GET /produtos
**Retorna todos os produtos.**


#### Retorno:
```json
[
 {
    "cabecalho": {
        "status": 200,
        "mensagem": "Dados retornados com sucesso"
    },
    "retorno": [
        {
            "id": "1",
            "nome": "Produto 1",
            "quantidade": "0",
            "descricao": "Descricao de teste 21",
            "preco": "150.00",
            "created_at": "2025-02-26 19:25:20",
            "updated_at": "2025-02-26 19:25:20"
        },
        {
            "id": "2",
            "nome": "Produto 2",
            "quantidade": "2",
            "descricao": "Descricao de teste 2",
            "preco": "200.00",
            "created_at": "2025-02-26 19:25:35",
            "updated_at": "2025-02-26 19:25:35"
        },
        {
            "id": "4",
            "nome": "Produto 3",
            "quantidade": "20",
            "descricao": "Descricao de teste 3",
            "preco": "200.00",
            "created_at": "2025-02-26 19:27:58",
            "updated_at": "2025-02-26 19:27:58"
        }
    ],
    "paginacao": {
        "current_page": 1,
        "per_page": 10,
        "total": 3,
        "last_page": 1,
        "next": null,
        "previous": null
    }
  }
]
```

### GET /produtos/{id}
**Retorna os detalhes de um produto.**

#### Retorno:
```json
{
  "cabecalho": {
      "status": 200,
      "mensagem": "Dados retornados com sucesso"
  },
  "retorno": {
      "id": "1",
      "nome": "Produto 1",
      "quantidade": "0",
      "descricao": "Descricao de teste 21",
      "preco": "150.00",
      "created_at": "2025-02-26 19:25:20",
      "updated_at": "2025-02-26 19:25:20"
  }
}
```

### POST /produtos
**Salva um novo produto.**

#### Payload:
```json
{
  "nome": "Produto novo",
  "quantidade": 50,
  "descricao": "Descricao do novo produto",
  "preco": 700
}
```

#### Retorno:
```json
{
  "cabecalho": {
      "status": 201,
      "mensagem": "Dados criados com sucesso"
  },
  "retorno": {
      "nome": "Produto novo",
      "quantidade": 50,
      "descricao": "Descricao do novo produto",
      "preco": 700
  }
}
```

### PUT /produtos/{id}
**Modifica um produto (nome, quantidade, descricao ou preco).**

#### Payload:
```json
{
  "nome": "Produto atualizado",
  "quantidade": 50,
  "descricao": "Descricao do novo produto",
  "preco": 700
}
```

#### Retorno:
```json
{
  "cabecalho": {
      "status": 200,
      "mensagem": "Dados atualizados com sucesso"
  },
  "retorno": {
      "nome": "Produto atualizado",
      "quantidade": 50,
      "descricao": "Descricao do novo produto",
      "preco": 700
  }
}
```

### DELETE /produtos/{id}
**Deleta um produto existente**

#### Retorno:
```json
{
  "cabecalho": {
      "status": 204,
      "mensagem": "Produto deletado com sucesso"
  },
  "retorno": []
}
```

---

## Rotas da aplicação para clientes


### GET /clientes
**Retorna todos os clientes.**


#### Retorno:
```json
[
  {
    "cabecalho": {
        "status": 200,
        "mensagem": "Dados retornados com sucesso"
    },
    "retorno": [
        {
            "id": "1",
            "cpf_cnpj": "452.610.228-44",
            "nome_razao_social": "teste",
            "created_at": "2025-02-26 19:23:24",
            "updated_at": "2025-02-26 19:23:24"
        },
        {
            "id": "2",
            "cpf_cnpj": "452.610.228-41",
            "nome_razao_social": "Rafael",
            "created_at": "2025-02-26 19:24:31",
            "updated_at": "2025-02-26 19:24:31"
        }
    ],
    "paginacao": {
        "current_page": 1,
        "per_page": 10,
        "total": 2,
        "last_page": 1,
        "next": null,
        "previous": null
    }
  }
]
```

### GET /clientes/{id}
**Retorna os detalhes de um cliente.**

#### Retorno:
```json
{
  "cabecalho": {
      "status": 200,
      "mensagem": "Dados retornados com sucesso"
  },
  "retorno": {
      "id": "1",
      "cpf_cnpj": "452.610.228-44",
      "nome_razao_social": "teste",
      "created_at": "2025-02-26 19:23:24",
      "updated_at": "2025-02-26 19:23:24"
  }
}
```

### POST /clientes
**Salva um novo cliente**

#### Payload:
```json
{
  "nome_razao_social": "Rafael",
  "cpf_cnpj": "452.610.228-41"
}
```

#### Retorno:
```json
{
  "cabecalho": {
      "status": 201,
      "mensagem": "Dados criados com sucesso"
  },
  "retorno": {
      "nome_razao_social": "Rafael",
      "cpf_cnpj": "452.610.228-41"
  }
}
```

### PUT /clientes/{id}
**Modifica um cliente (nome_razao_social e cpf_cnpj).**

#### Payload:
```json
{
  "nome_razao_social": "Rafael modificado"
}
```

#### Retorno:
```json
{
  "cabecalho": {
      "status": 200,
      "mensagem": "Dados atualizados com sucesso"
  },
  "retorno": {
      "nome_razao_social": "Rafael modificado"
  }
}
```

### DELETE /cliente/{id}
**Deleta um cliente existente**

#### Retorno:
```json
{
  "cabecalho": {
      "status": 204,
      "mensagem": "Dado deletado com sucesso"
  },
  "retorno": []
}
```



---

## Rotas da aplicação para pedidos


### GET /pedidos
**Retorna todos os pedidos.**


#### Retorno:
```json
[
  {
  "cabecalho": {
      "status": 200,
      "mensagem": "Dados retornados com sucesso"
  },
  "pedidos": [
      {
        "id": "1",
        "status": "Em Aberto",
        "created_at": "2025-02-27 13:59:55",
        "updated_at": "2025-02-27 13:59:55",
        "itens": [
          {
            "id": "1",
            "pedido_id": "1",
            "produto_id": "1",
            "quantidade": "1",
            "preco": "120.00",
            "created_at": "2025-02-27 13:59:55",
            "updated_at": "2025-02-27 13:59:55"
          }
        ],
        "cliente": {
          "id": "1",
          "nome_razao_social": "Rafael",
          "cpf_cnpj": "452.610.228-41"
        }
    }
  ],
  "paginacao": {
      "current_page": 1,
      "per_page": 10,
      "total": 1,
      "last_page": 1,
      "next": null,
      "previous": null
  }
  }
]
```

### GET /pedidos/{id}
**Retorna os detalhes de um pedido.**

#### Retorno:
```json
{
  "cabecalho": {
      "status": 200,
      "mensagem": "Dados retornados com sucesso"
  },
  "retorno": {
      "id": "5",
      "cliente_id": "2",
      "status": "Em Aberto",
      "created_at": "2025-02-26 22:28:10",
      "updated_at": "2025-02-26 22:28:10",
      "itens": [
          {
            "id": "7",
            "pedido_id": "5",
            "produto_id": "1",
            "quantidade": "1",
            "preco": "120.00",
            "created_at": "2025-02-26 22:28:10",
            "updated_at": "2025-02-26 22:28:10"
          }
      ]
  }
}
```

### POST /pedidos
**Salva um novo pedido**

#### Payload:
```json
{
  "cliente_id": 2,
  "status": "Em Aberto",
  "itens": [
    {
      "produto_id": 1,
      "quantidade": 1,
      "preco": 120.00
    }
  ]
}

```

#### Retorno:
```json
{
  "cabecalho": {
    "status": 201,
    "mensagem": "Pedido criado com sucesso"
  },
  "retorno": {
    "id": "5",
    "cliente_id": "2",
    "status": "Em Aberto",
    "created_at": "2025-02-26 22:28:10",
    "updated_at": "2025-02-26 22:28:10"
  }
}
```

### PATCH /pedidos/5/status
**Modifica o status do pedido.**

#### Payload:
```json
{
  "status": "Pago"
}
```

#### Retorno:
```json
{
  "cabecalho": {
      "status": 200,
      "mensagem": "Status do pedido atualizado com sucesso"
  },
  "retorno": {
    "id": "5",
    "cliente_id": "2",
    "status": "Pago",
    "created_at": "2025-02-26 22:28:10",
    "updated_at": "2025-02-26 22:34:31",
    "itens": [
      {
        "id": "7",
        "pedido_id": "5",
        "produto_id": "1",
        "quantidade": "1",
        "preco": "120.00",
        "created_at": "2025-02-26 22:28:10",
        "updated_at": "2025-02-26 22:28:10"
      }
    ]
  }
}
```

### DELETE /pedidos/{id}
**Deleta um pedido existente**

#### Retorno:
```json
{
  "cabecalho": {
      "status": 204,
      "mensagem": "Pedido deletado com sucesso"
  },
  "retorno": []
}
```

