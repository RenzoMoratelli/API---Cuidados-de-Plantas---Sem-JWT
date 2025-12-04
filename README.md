# API RESTful - Catálogo e Cuidados de Plantas

API desenvolvida em PHP utilizando o padrão MVC com separação em camadas (Controller, Service, DAO) para gerenciar um catálogo de plantas e seus cuidados.

## 📋 Índice

- [Requisitos](#requisitos)
- [Instalação](#instalação)
- [Estrutura do Projeto](#estrutura-do-projeto)
- [Banco de Dados](#banco-de-dados)
- [Endpoints](#endpoints)
  - [Plantas](#plantas)
  - [Usuários](#usuários)
  - [Cuidados](#cuidados)
- [Exemplos de Uso](#exemplos-de-uso)
- [Códigos de Resposta](#códigos-de-resposta)

## 🔧 Requisitos

- PHP 7.4 ou superior
- MySQL 5.7 ou superior
- Apache com mod_rewrite habilitado
- Extensão PDO do PHP habilitada

## 📦 Instalação

1. Clone o repositório ou extraia os arquivos na pasta do seu servidor web (ex: `htdocs/mvcPlantas`)

2. Importe o banco de dados:
```sql
mysql -u root -p < mvcplantas.sql
```

3. Configure a conexão com o banco de dados em `generic/MysqlSingleton.php`:
```php
private $dsn = 'mysql:host=localhost;dbname=mvcplantas;charset=utf8mb4';
private $usuario = 'root';
private $senha = '';
```

4. Certifique-se de que o arquivo `.htaccess` está configurado corretamente

5. Acesse a API através de: `http://localhost/mvcPlantas/`

## 📁 Estrutura do Projeto

```
mvcPlantas/
│
├── controller/              # Camada de Controllers
│   ├── PlantaController.php
│   ├── UsuarioController.php
│   └── CuidadoController.php
│
├── service/                 # Camada de Services (Regras de negócio)
│   ├── PlantaService.php
│   ├── UsuarioService.php
│   └── CuidadoService.php
│
├── dao/                     # Camada de DAO (Acesso a dados)
│   ├── IPlantaDAO.php
│   ├── IUsuarioDAO.php
│   ├── ICuidadoDAO.php
│   └── mysql/
│       ├── PlantaDAO.php
│       ├── UsuarioDAO.php
│       └── CuidadoDAO.php
│
├── generic/                 # Classes genéricas
│   ├── Acao.php
│   ├── Autoload.php
│   ├── Controller.php
│   ├── Endpoint.php
│   ├── MysqlFactory.php
│   ├── MysqlSingleton.php
│   ├── Retorno.php
│   └── Rotas.php
│
├── .htaccess
├── index.php
└── README.md
```

## 🗄️ Banco de Dados

### Tabelas

**plantas**
- `id` (INT, PK, AUTO_INCREMENT)
- `nome_cientifico` (VARCHAR 150)
- `nome_popular` (VARCHAR 100)

**usuarios**
- `id` (INT, PK, AUTO_INCREMENT)
- `nome` (VARCHAR 100)
- `email` (VARCHAR 100, UNIQUE)

**cuidados**
- `id` (INT, PK, AUTO_INCREMENT)
- `usuario_id` (INT, FK -> usuarios.id)
- `planta_id` (INT, FK -> plantas.id)
- `tipo_cuidado` (VARCHAR 100)
- `frequencia` (INT) - Frequência em dias

## 🚀 Endpoints

### Base URL
```
http://localhost/mvcPlantas/
```

---

## 🌱 Plantas

### 1. Listar todas as plantas

**Endpoint:** `GET /plantas`

**Resposta de Sucesso:**
```json
{
  "erro": null,
  "dados": {
    "sucesso": true,
    "dados": [
      {
        "id": "12241",
        "nome_cientifico": "Ficus lyrata",
        "nome_popular": "Figueira-lira"
      }
    ],
    "mensagem": "Plantas listadas com sucesso"
  }
}
```

### 2. Buscar planta por ID

**Endpoint:** `GET /plantas/buscar?id={id}`

**Parâmetros:**
- `id` (obrigatório): ID da planta

**Resposta de Sucesso:**
```json
{
  "erro": null,
  "dados": {
    "sucesso": true,
    "dados": [
      {
        "id": "12241",
        "nome_cientifico": "Ficus lyrata",
        "nome_popular": "Figueira-lira"
      }
    ],
    "mensagem": "Planta encontrada"
  }
}
```

### 3. Cadastrar nova planta

**Endpoint:** `POST /plantas`

**Body (JSON):**
```json
{
  "nome_cientifico": "Ficus lyrata",
  "nome_popular": "Figueira-lira"
}
```

**Resposta de Sucesso:**
```json
{
  "erro": null,
  "dados": {
    "sucesso": true,
    "mensagem": "Planta cadastrada com sucesso"
  }
}
```

### 4. Alterar planta

**Endpoint:** `PUT /plantas/alterar`

**Body (JSON):**
```json
{
  "id": 12241,
  "nome_cientifico": "Ficus lyrata",
  "nome_popular": "Figueira-lira"
}
```

**Resposta de Sucesso:**
```json
{
  "erro": null,
  "dados": {
    "sucesso": true,
    "mensagem": "Planta alterada com sucesso"
  }
}
```

### 5. Deletar planta

**Endpoint:** `DELETE /plantas/deletar`

**Body (JSON):**
```json
{
  "id": 12241
}
```

**Resposta de Sucesso:**
```json
{
  "erro": null,
  "dados": {
    "sucesso": true,
    "mensagem": "Planta deletada com sucesso"
  }
}
```

---

## 👤 Usuários

### 1. Listar todos os usuários

**Endpoint:** `GET /usuarios`

**Resposta de Sucesso:**
```json
{
  "erro": null,
  "dados": {
    "sucesso": true,
    "dados": [
      {
        "id": "10",
        "nome": "Ana Silva",
        "email": "ana.silva@email.com"
      }
    ],
    "mensagem": "Usuários listados com sucesso"
  }
}
```

### 2. Buscar usuário por ID

**Endpoint:** `GET /usuarios/buscar?id={id}`

**Parâmetros:**
- `id` (obrigatório): ID do usuário

**Resposta de Sucesso:**
```json
{
  "erro": null,
  "dados": {
    "sucesso": true,
    "dados": [
      {
        "id": "10",
        "nome": "Ana Silva",
        "email": "ana.silva@email.com"
      }
    ],
    "mensagem": "Usuário encontrado"
  }
}
```

### 3. Cadastrar novo usuário

**Endpoint:** `POST /usuarios`

**Body (JSON):**
```json
{
  "nome": "Ana Silva",
  "email": "ana.silva@email.com"
}
```

**Resposta de Sucesso:**
```json
{
  "erro": null,
  "dados": {
    "sucesso": true,
    "mensagem": "Usuário cadastrado com sucesso"
  }
}
```

### 4. Alterar usuário

**Endpoint:** `PUT /usuarios/alterar`

**Body (JSON):**
```json
{
  "id": 10,
  "nome": "Ana Silva Santos",
  "email": "ana.santos@email.com"
}
```

**Resposta de Sucesso:**
```json
{
  "erro": null,
  "dados": {
    "sucesso": true,
    "mensagem": "Usuário alterado com sucesso"
  }
}
```

### 5. Deletar usuário

**Endpoint:** `DELETE /usuarios/deletar`

**Body (JSON):**
```json
{
  "id": 10
}
```

**Resposta de Sucesso:**
```json
{
  "erro": null,
  "dados": {
    "sucesso": true,
    "mensagem": "Usuário deletado com sucesso"
  }
}
```

---

## 🌿 Cuidados

### 1. Listar todos os cuidados

**Endpoint:** `GET /cuidados`

**Resposta de Sucesso:**
```json
{
  "erro": null,
  "dados": {
    "sucesso": true,
    "dados": [
      {
        "id": "19",
        "usuario_id": "10",
        "usuario_nome": "Ana Silva",
        "planta_id": "12241",
        "planta_nome": "Figueira-lira",
        "tipo_cuidado": "Regar",
        "frequencia": "3"
      }
    ],
    "mensagem": "Cuidados listados com sucesso"
  }
}
```

### 2. Buscar cuidado por ID

**Endpoint:** `GET /cuidados/buscar?id={id}`

**Parâmetros:**
- `id` (obrigatório): ID do cuidado

**Resposta de Sucesso:**
```json
{
  "erro": null,
  "dados": {
    "sucesso": true,
    "dados": [
      {
        "id": "19",
        "usuario_id": "10",
        "usuario_nome": "Ana Silva",
        "planta_id": "12241",
        "planta_nome": "Figueira-lira",
        "tipo_cuidado": "Regar",
        "frequencia": "3"
      }
    ],
    "mensagem": "Cuidado encontrado"
  }
}
```

### 3. Buscar cuidados por usuário

**Endpoint:** `GET /cuidados/usuario?usuario_id={usuario_id}`

**Parâmetros:**
- `usuario_id` (obrigatório): ID do usuário

**Resposta de Sucesso:**
```json
{
  "erro": null,
  "dados": {
    "sucesso": true,
    "dados": [
      {
        "id": "19",
        "usuario_id": "10",
        "usuario_nome": "Ana Silva",
        "planta_id": "12241",
        "planta_nome": "Figueira-lira",
        "tipo_cuidado": "Regar",
        "frequencia": "3"
      }
    ],
    "mensagem": "Cuidados do usuário listados com sucesso"
  }
}
```

### 4. Buscar cuidados por planta

**Endpoint:** `GET /cuidados/planta?planta_id={planta_id}`

**Parâmetros:**
- `planta_id` (obrigatório): ID da planta

**Resposta de Sucesso:**
```json
{
  "erro": null,
  "dados": {
    "sucesso": true,
    "dados": [
      {
        "id": "19",
        "usuario_id": "10",
        "usuario_nome": "Ana Silva",
        "planta_id": "12241",
        "planta_nome": "Figueira-lira",
        "tipo_cuidado": "Regar",
        "frequencia": "3"
      }
    ],
    "mensagem": "Cuidados da planta listados com sucesso"
  }
}
```

### 5. Cadastrar novo cuidado

**Endpoint:** `POST /cuidados`

**Body (JSON):**
```json
{
  "usuario_id": 10,
  "planta_id": 12241,
  "tipo_cuidado": "Regar",
  "frequencia": 3
}
```

**Resposta de Sucesso:**
```json
{
  "erro": null,
  "dados": {
    "sucesso": true,
    "mensagem": "Cuidado cadastrado com sucesso"
  }
}
```

### 6. Alterar cuidado

**Endpoint:** `PUT /cuidados/alterar`

**Body (JSON):**
```json
{
  "id": 19,
  "usuario_id": 10,
  "planta_id": 12241,
  "tipo_cuidado": "Regar",
  "frequencia": 5
}
```

**Resposta de Sucesso:**
```json
{
  "erro": null,
  "dados": {
    "sucesso": true,
    "mensagem": "Cuidado alterado com sucesso"
  }
}
```

### 7. Deletar cuidado

**Endpoint:** `DELETE /cuidados/deletar`

**Body (JSON):**
```json
{
  "id": 19
}
```

**Resposta de Sucesso:**
```json
{
  "erro": null,
  "dados": {
    "sucesso": true,
    "mensagem": "Cuidado deletado com sucesso"
  }
}
```

---

## 💡 Exemplos de Uso

### Usando cURL

**GET - Listar plantas:**
```bash
curl -X GET http://localhost/mvcPlantas/plantas
```

**POST - Cadastrar planta:**
```bash
curl -X POST http://localhost/mvcPlantas/plantas \
  -H "Content-Type: application/json" \
  -d '{"nome_cientifico":"Ficus lyrata","nome_popular":"Figueira-lira"}'
```

**PUT - Alterar planta:**
```bash
curl -X PUT http://localhost/mvcPlantas/plantas/alterar \
  -H "Content-Type: application/json" \
  -d '{"id":12241,"nome_cientifico":"Ficus lyrata","nome_popular":"Figueira"}'
```

**DELETE - Deletar planta:**
```bash
curl -X DELETE http://localhost/mvcPlantas/plantas/deletar \
  -H "Content-Type: application/json" \
  -d '{"id":12241}'
```

### Usando JavaScript (Fetch API)

**GET - Listar plantas:**
```javascript
fetch('http://localhost/mvcPlantas/plantas')
  .then(response => response.json())
  .then(data => console.log(data));
```

**POST - Cadastrar planta:**
```javascript
fetch('http://localhost/mvcPlantas/plantas', {
  method: 'POST',
  headers: {
    'Content-Type': 'application/json'
  },
  body: JSON.stringify({
    nome_cientifico: 'Ficus lyrata',
    nome_popular: 'Figueira-lira'
  })
})
  .then(response => response.json())
  .then(data => console.log(data));
```

---

## 📊 Códigos de Resposta

### Respostas de Sucesso

| Código | Descrição |
|--------|-----------|
| 200 OK | Requisição bem-sucedida |

### Respostas de Erro

| Código | Descrição |
|--------|-----------|
| 404 Not Found | Endpoint não encontrado |
| 500 Internal Server Error | Erro no servidor |

### Estrutura de Resposta de Erro

```json
{
  "erro": null,
  "dados": {
    "sucesso": false,
    "mensagem": "Descrição do erro"
  }
}
```

### Mensagens de Erro Comuns

- **"ID inválido"**: O ID fornecido não é válido ou está vazio
- **"Nome científico é obrigatório"**: Campo obrigatório não fornecido
- **"Email inválido"**: Formato de email inválido
- **"Planta não encontrada"**: Recurso não existe no banco de dados
- **"Usuário não encontrado"**: Recurso não existe no banco de dados
- **"Frequência deve ser um número positivo"**: Valor inválido para frequência

---

## 🔐 Validações

### Plantas
- `nome_cientifico`: Obrigatório
- `nome_popular`: Obrigatório

### Usuários
- `nome`: Obrigatório
- `email`: Obrigatório e deve ser válido

### Cuidados
- `usuario_id`: Obrigatório, numérico e deve existir na tabela usuarios
- `planta_id`: Obrigatório, numérico e deve existir na tabela plantas
- `tipo_cuidado`: Obrigatório
- `frequencia`: Obrigatório, numérico e maior que zero

---

## 🏗️ Arquitetura

### Padrão MVC em 3 Camadas

**Controller (Camada de Apresentação)**
- Recebe as requisições HTTP
- Valida dados de entrada básicos
- Chama os métodos do Service
- Retorna respostas em JSON

**Service (Camada de Negócio)**
- Contém as regras de negócio
- Realiza validações complexas
- Gerencia transações
- Chama os métodos do DAO

**DAO (Camada de Dados)**
- Acesso direto ao banco de dados
- Executa queries SQL
- Retorna dados brutos

### Princípios Aplicados

- **Single Responsibility Principle**: Cada classe tem uma única responsabilidade
- **Interface Segregation**: Uso de interfaces para definir contratos
- **Dependency Inversion**: Classes dependem de abstrações (interfaces)
- **Singleton Pattern**: Conexão única com o banco de dados
- **Factory Pattern**: Criação de objetos DAO

---

## 📝 Notas

1. Todos os endpoints retornam JSON
2. A API suporta CORS para permitir requisições de diferentes origens
3. As datas e caracteres especiais estão configurados para UTF-8
4. O banco de dados usa charset utf8mb4 para suporte completo a caracteres especiais

---

## 🤝 Contribuindo

Para contribuir com este projeto:

1. Faça um fork do repositório
2. Crie uma branch para sua feature (`git checkout -b feature/nova-feature`)
3. Commit suas mudanças (`git commit -am 'Adiciona nova feature'`)
4. Push para a branch (`git push origin feature/nova-feature`)
5. Crie um Pull Request

---

## 📄 Licença

Este projeto está sob a licença MIT.

---

## 👨‍💻 Autor

Desenvolvido como projeto acadêmico para demonstração do padrão MVC em PHP.