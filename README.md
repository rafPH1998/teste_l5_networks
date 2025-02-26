# L5 Networks

## Descrição Geral

O desafio consiste em implementar uma API REST utilizando o framework PHP
Codeigniter 4, e um banco de dados relacional MySQL.

---

## Requisitos de Instalação

Certifique-se de ter as seguintes ferramentas instaladas:

- **Docker**: v27.4.x
- **Docker Compose**: v1.29.x
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

2. Execute o comando para obter o banco de dados rodando em sua máquina local:
   ```bash
   docker-compose up -d
   ```

2. Execute o comando para rodar o servidor e ter acesso ao projeto:
  ```bash
  php -S localhost:8000 -t public
  ```
Após a execução dos comandos acima, acesse o projeto no seu navegador através do localhost:8000.

---


## Rotas da Aplicação para produtos


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

**Nota:** Não foi adicionado a autenticação, por tanto não é necessário passar o token para cada requisição.
